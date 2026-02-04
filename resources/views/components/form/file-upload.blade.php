@props([
    'name',
    'label' => '',
    'accept' => 'image/*',
    'helper' => '',
    'error' => '',
    'required' => false,
    'preview' => false,
    'previewUrl' => '',
])

<div class="space-y-2">
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-neutral-900 dark:text-white">
            {{ $label }}
            @if ($required)
                <span class="text-danger-600 dark:text-danger-400">*</span>
            @endif
        </label>
    @endif

    <div
        x-data="fileUpload('{{ $name }}')"
        @drop="handleDrop"
        @dragover="isDragging = true"
        @dragleave="isDragging = false"
        class="relative"
    >
        <!-- Upload Area -->
        <div
            :class="{ 'border-primary-500 bg-primary-50 dark:bg-primary-900/10': isDragging }"
            class="border-2 border-dashed border-neutral-300 dark:border-neutral-700 rounded-lg p-6 text-center cursor-pointer transition-all duration-200 hover:border-primary-500 dark:hover:border-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/10"
        >
            <input
                type="file"
                id="{{ $name }}"
                name="{{ $name }}"
                accept="{{ $accept }}"
                {{ $required ? 'required' : '' }}
                @change="handleFileChange"
                class="hidden"
            />

            <label for="{{ $name }}" class="cursor-pointer block">
                <svg class="w-12 h-12 mx-auto text-neutral-400 dark:text-neutral-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                <p class="text-sm font-medium text-neutral-900 dark:text-white">
                    Drop your file here or <span class="text-primary-600 dark:text-primary-400">click to browse</span>
                </p>
                <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-1">
                    @if ($accept === 'image/*')
                        PNG, JPG, GIF up to 5MB
                    @else
                        Supported formats up to 10MB
                    @endif
                </p>
            </label>
        </div>

        <!-- File Preview -->
        <template x-if="preview && previewUrl">
            <div class="mt-4">
                <img :src="previewUrl" alt="Preview" class="w-full h-48 object-cover rounded-lg border border-neutral-200 dark:border-neutral-700">
            </div>
        </template>

        <!-- File Name Display -->
        <template x-if="fileName">
            <div class="mt-4 p-4 rounded-lg bg-success-50 dark:bg-success-900/20 border border-success-200 dark:border-success-800">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-success-600 dark:text-success-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 16.5a1 1 0 01-1-1V9.707l-3.146 3.147a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0l5 5a1 1 0 01-1.414 1.414L9 9.707V15.5a1 1 0 01-1 1z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-medium text-neutral-900 dark:text-white" x-text="fileName"></span>
                    </div>
                    <button type="button" @click="clearFile" class="text-sm text-danger-600 dark:text-danger-400 hover:text-danger-700">
                        Remove
                    </button>
                </div>
            </div>
        </template>
    </div>

    @if ($error)
        <p class="text-sm text-danger-600 dark:text-danger-400 font-medium">{{ $error }}</p>
    @elseif ($helper)
        <p class="text-xs text-neutral-600 dark:text-neutral-400">{{ $helper }}</p>
    @endif
</div>

<script>
    function fileUpload(inputName) {
        return {
            isDragging: false,
            fileName: '',
            previewUrl: '',

            handleFileChange(e) {
                const files = e.target.files;
                if (files.length > 0) {
                    this.fileName = files[0].name;
                    this.createPreview(files[0]);
                }
            },

            handleDrop(e) {
                e.preventDefault();
                this.isDragging = false;
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    document.getElementById(inputName).files = files;
                    this.fileName = files[0].name;
                    this.createPreview(files[0]);
                }
            },

            createPreview(file) {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.previewUrl = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },

            clearFile() {
                document.getElementById(inputName).value = '';
                this.fileName = '';
                this.previewUrl = '';
            },
        };
    }
</script>
