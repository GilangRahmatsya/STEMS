<?php

namespace App\Livewire\Admin;

use App\Models\PhotoboothEvent;
use App\Models\PhotoboothQueue;
use Livewire\Component;
use Livewire\WithPagination;

class Photobooth extends Component
{
    use WithPagination;

    public $activeTab = 'events';
    public $showEventModal = false;
    public $showQueueModal = false;
    public $editingEvent = null;
    public $selectedEventId = null;

    // Event form fields
    public $eventTitle = '';
    public $stripsCount = 1;
    public $pricePerStrip = '';

    // Queue form fields
    public $customerName = '';
    public $stripsOrdered = 1;
    public $whatsappNumber = '';

    protected $rules = [
        'eventTitle' => 'required|string|max:255',
        'stripsCount' => 'required|integer|min:1',
        'pricePerStrip' => 'required|numeric|min:0',
        'customerName' => 'required|string|max:255',
        'stripsOrdered' => 'required|integer|min:1',
        'whatsappNumber' => 'required|string|max:20',
    ];

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function openEventModal()
    {
        $this->resetEventForm();
        $this->showEventModal = true;
    }

    public function editEvent($eventId)
    {
        $event = PhotoboothEvent::find($eventId);
        if ($event) {
            $this->editingEvent = $event;
            $this->eventTitle = $event->title;
            $this->stripsCount = $event->strips_count;
            $this->pricePerStrip = $event->price_per_strip;
            $this->showEventModal = true;
        }
    }

    public function saveEvent()
    {
        $this->validate([
            'eventTitle' => 'required|string|max:255',
            'stripsCount' => 'required|integer|min:1',
            'pricePerStrip' => 'required|numeric|min:0',
        ]);

        $data = [
            'title' => $this->eventTitle,
            'strips_count' => $this->stripsCount,
            'price_per_strip' => $this->pricePerStrip,
        ];

        if ($this->editingEvent) {
            $this->editingEvent->update($data);
            session()->flash('message', 'Photobooth event updated successfully.');
        } else {
            PhotoboothEvent::create($data);
            session()->flash('message', 'Photobooth event created successfully.');
        }

        $this->closeEventModal();
    }

    public function deleteEvent($eventId)
    {
        try {
            $event = PhotoboothEvent::findOrFail($eventId);

            // Check if event has active queues (not picked up)
            $activeQueues = $event->queues()->where('is_picked_up', false)->count();

            if ($activeQueues > 0) {
                session()->flash('error', 'Cannot delete event with active queues. Please complete all queues first.');
                return;
            }

            // Delete associated financial records first
            $event->queues()->each(function ($queue) {
                $queue->financialRecord()->delete();
            });

            // Delete the event (this will cascade delete queues due to foreign key constraint)
            $event->delete();

            session()->flash('message', 'Photobooth event deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete event: ' . $e->getMessage());
        }
    }

    public function toggleEventStatus($eventId)
    {
        $event = PhotoboothEvent::find($eventId);
        if ($event) {
            $event->update(['is_active' => !$event->is_active]);
            session()->flash('message', 'Event status updated successfully.');
        }
    }

    public function selectEvent($eventId)
    {
        $this->selectedEventId = $eventId;
        $this->activeTab = 'queues';
    }

    public function openQueueModal()
    {
        if (!$this->selectedEventId) {
            session()->flash('error', 'Please select an event first.');
            return;
        }
        $this->resetQueueForm();
        $this->showQueueModal = true;
    }

    public function saveQueue()
    {
        if (!$this->selectedEventId) {
            session()->flash('error', 'Please select an event first.');
            return;
        }

        $selectedEvent = PhotoboothEvent::find($this->selectedEventId);
        if (!$selectedEvent) {
            session()->flash('error', 'Event not found.');
            return;
        }

        $this->validate([
            'customerName' => 'required|string|max:255',
            'stripsOrdered' => 'required|integer|min:1',
            'whatsappNumber' => 'required|string|max:20',
        ]);

        PhotoboothQueue::create([
            'photobooth_event_id' => $this->selectedEventId,
            'customer_name' => $this->customerName,
            'strips_ordered' => $this->stripsOrdered,
            'whatsapp_number' => $this->whatsappNumber,
            'total_amount' => $selectedEvent->price_per_strip * $this->stripsOrdered,
        ]);

        session()->flash('message', 'Queue added successfully.');
        $this->closeQueueModal();
    }

    public function updateQueueStatus($queueId, $status)
    {
        $queue = PhotoboothQueue::find($queueId);
        if ($queue) {
            $timestampField = $status . '_at';
            $booleanField = 'is_' . $status;

            $queue->update([
                $booleanField => !$queue->$booleanField,
                $timestampField => $queue->$booleanField ? null : now(),
            ]);

            session()->flash('message', 'Queue status updated successfully.');
        }
    }

    public function deleteQueue($queueId)
    {
        try {
            $queue = PhotoboothQueue::findOrFail($queueId);

            // Check if queue has been paid and processed
            if ($queue->is_paid && ($queue->is_photographed || $queue->is_printed || $queue->is_ready)) {
                session()->flash('error', 'Cannot delete queue that has been paid and processed. Please complete the order first.');
                return;
            }

            // Delete associated financial record
            $queue->financialRecord()->delete();

            $queue->delete();
            session()->flash('message', 'Queue deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete queue: ' . $e->getMessage());
        }
    }

    public function closeEventModal()
    {
        $this->showEventModal = false;
        $this->editingEvent = null;
        $this->resetEventForm();
    }

    public function closeQueueModal()
    {
        $this->showQueueModal = false;
        $this->resetQueueForm();
    }

    private function resetEventForm()
    {
        $this->eventTitle = '';
        $this->stripsCount = 1;
        $this->pricePerStrip = '';
    }

    private function resetQueueForm()
    {
        $this->customerName = '';
        $this->stripsOrdered = 1;
        $this->whatsappNumber = '';
    }

    public function getEventsProperty()
    {
        return PhotoboothEvent::orderBy('created_at', 'desc')->get();
    }

    public function getQueuesProperty()
    {
        if (!$this->selectedEventId) {
            return collect();
        }

        return PhotoboothQueue::where('photobooth_event_id', $this->selectedEventId)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
    }

    public function getTotalRevenueProperty()
    {
        return PhotoboothQueue::whereHas('photoboothEvent', fn($q) => $q->where('is_active', true))
            ->where('is_paid', true)
            ->sum('total_amount');
    }

    public function render()
    {
        return view('livewire.admin.photobooth', [
            'events' => $this->events,
            'queues' => $this->queues,
            'totalRevenue' => $this->totalRevenue,
        ])->layout('layouts.app');
    }
}