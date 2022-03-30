<?php

namespace App;

/**
 * Pagination class
 */
class Pagination
{
    /**
     * Number of items per page
     * @var int
     */
    const ITEMS_PER_PAGE = 5;

    /**
     * Current page number
     * @var int
     */
    protected int $page_nbr;

    /**
     * List of items
     * @var array
     */
    protected array $items;

    /**
     * Total number of items
     * @var int
     */
    protected int $total_items;

    public function __construct(int $page_nbr, array $items)
    {
        $this->page_nbr = $page_nbr;
        $this->items = $items;
        $this->total_items = count($items);
    }

    /**
     * Get total number of pages
     * @return int
     */
    public function get_page_count(): int
    {
        return ceil($this->total_items / self::ITEMS_PER_PAGE);
    }

    /**
     * Get start index for current page
     * @return int
     */
    public function get_page_start(): int
    {
        return ($this->page_nbr - 1) * self::ITEMS_PER_PAGE;
    }

    /**
     * Get end index for current page
     * @return int
     */
    public function get_page_end(): int
    {
        return $this->page_nbr * self::ITEMS_PER_PAGE;
    }

    /**
     * Get previous page number
     * @return int|null
     */
    public function get_previous_page(): ?int
    {
        if ($this->is_first_page()) return NULL;
        return $this->page_nbr - 1;
    }

    /**
     * Get next page number
     * @return int|null
     */
    public function get_next_page(): ?int
    {
        if ($this->is_last_page()) return NULL;
        return $this->page_nbr + 1;
    }

    /**
     * Check if current page is first page
     * @return bool
     */
    public function is_first_page(): bool
    {
        return $this->page_nbr == 1;
    }

    /**
     * Check if current page is last page
     * @return bool
     */
    public function is_last_page(): bool
    {
        return $this->page_nbr == $this->get_page_count();
    }

    public function get_page_items(): array
    {
        return array_slice($this->items, $this->get_page_start(), self::ITEMS_PER_PAGE);
    }

    public function render(): void
    {
        echo '<nav aria-label="Navigation"><ul class="pagination justify-content-center">';
        echo '<li class="page-item disabled"><a class="page-link">Page ' . $this->page_nbr . ' of ' . $this->get_page_count() . '</a></li>';
        if (!$this->is_first_page()) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . $this->get_previous_page() . '">Previous</a></li>';
        }

        echo '<li class="page-item active"><a class="page-link">' . $this->page_nbr . '</a></li>';


        if (!$this->is_last_page()) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . $this->get_next_page() . '">Next</a></li>';
        }
        echo '</ul></nav>';
    }
}
