<?php
namespace ExcitedCells;

final class Cell {
    public const EXCITED = true;
    public const QUIET = false;

    /**
     * An internal counter counting how many messages are received by the current cell.
     */
    private int $messagesReceived;

    /**
     * The internal state of the current cell.
     */
    private bool $state;

    /**
     * Default constructor
     *
     * @param mixed $initialState [optional] The initial state of the cell.
     */
    public function __construct($initialState = false) {
        $this->state = is_bool($initialState) ? $initialState : boolval($initialState);
        $this->messagesReceived = 0;
    }

    /**
     * Indicates if the current cell is excited or not.
     *
     * @return bool
     */
    public function isExcited(): bool {
        return $this->state;
    }

    /**
     * Returns the number of messages received by the current cell.
     *
     * @return int
     */
    public function getMessagesReceived(): int {
        return $this->messagesReceived;
    }

    /**
     * Indicates if the current cell has received messages or not.
     *
     * @return bool
     */
    public function hasReceivedMessages(): bool {
        return $this->messagesReceived > 0;
    }

    /**
     * Sends a message to neighboring cells if the current cell is excited.
     *
     * @param \ExcitedCells\Cell $left The left neighbor of the current cell.
     * @param \ExcitedCells\Cell $right The right neighbor of the current cell.
     * @return void
     */
    public function sendMessage(?Cell $left, ?Cell $right): void {
        if (!$this->state) {
            return;
        }

        if ($left !== null) {
            $left->receiveMessage();
        }
        if ($right !== null) {
            $right->receiveMessage();
        }
    }

    /**
     * Calls this method when you want to indicates to the cell it has received a message.
     * If it has already received two messages, the internal counter of the cell will not be updated.
     *
     * @return void
     */
    public function receiveMessage(): void {
        if ($this->messagesReceived >= 2) {
            return;
        }

        $this->messagesReceived++;
    }

    /**
     * Transitions the current cell to its next step by mutating its internal state based on the number
     * of messages received.
     *
     * @return void
     */
    public function nextState(): void {
        $this->state = $this->messagesReceived === 1 ? self::EXCITED : self::QUIET;
        $this->messagesReceived = 0;
    }

    /**
     * Magic method to cast the current cell into a string.
     *
     * @return string
     */
    public function __toString(): string {
        return $this->state ? '1' : '0';
    }
}
