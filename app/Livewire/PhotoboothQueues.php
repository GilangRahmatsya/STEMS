<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PhotoboothEvent;
use App\Models\PhotoboothQueue;

class PhotoboothQueues extends Component
{
    public $selectedEventId = null;

    public function mount()
    {
        // Auto-select the first active event if available
        $activeEvent = PhotoboothEvent::where('is_active', true)->first();
        if ($activeEvent) {
            $this->selectedEventId = $activeEvent->id;
        }
    }

    public function selectEvent($eventId)
    {
        $this->selectedEventId = $eventId;
    }

    public function getQueuesProperty()
    {
        if (!$this->selectedEventId) {
            return collect();
        }

        return PhotoboothQueue::where('photobooth_event_id', $this->selectedEventId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function getActiveEventsProperty()
    {
        return PhotoboothEvent::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getQueuePosition($queueId)
    {
        $queues = $this->queues;
        $position = 1;

        foreach ($queues as $queue) {
            if ($queue->id == $queueId) {
                return $position;
            }
            $position++;
        }

        return null;
    }

    public function getEstimatedWaitTime($queue)
    {
        $position = $this->getQueuePosition($queue->id);
        if (!$position) return null;

        // Estimate 5 minutes per person in queue
        $estimatedMinutes = ($position - 1) * 5;

        if ($estimatedMinutes < 60) {
            return "{$estimatedMinutes} minutes";
        } else {
            $hours = floor($estimatedMinutes / 60);
            $minutes = $estimatedMinutes % 60;
            return $minutes > 0 ? "{$hours}h {$minutes}m" : "{$hours}h";
        }
    }

    public function render()
    {
        return view('livewire.photobooth-queues', [
            'queues' => $this->queues,
            'activeEvents' => $this->active_events,
        ]);
    }
}