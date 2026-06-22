<?php

namespace App\Livewire\Concerns;

use Livewire\Attributes\Url;
use Livewire\WithPagination;

/**
 * Shared admin data-table behaviour: URL-synced search/sort (bookmarkable views),
 * pagination, and bulk selection. The consuming component builds its own query in
 * render() using $this->search / $this->sortField / $this->sortDirection.
 */
trait WithDataTable
{
    use WithPagination;

    #[Url(as: 'q', history: true, keep: false)]
    public string $search = '';

    #[Url(history: true)]
    public string $sortField = 'id';

    #[Url(history: true)]
    public string $sortDirection = 'desc';

    public int $perPage = 20;

    /** @var array<int, int|string> */
    public array $selected = [];

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';

            return;
        }

        $this->sortField = $field;
        $this->sortDirection = 'asc';
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->reset('search', 'selected');
        $this->resetPage();
    }

    /**
     * Normalise the sort direction to a safe value for SQL.
     */
    protected function safeSortDirection(): string
    {
        return $this->sortDirection === 'asc' ? 'asc' : 'desc';
    }
}
