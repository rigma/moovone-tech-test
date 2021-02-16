<?php
namespace ExcitedCells;

final class World {
    /**
     * The internal representation of the world
     */
    private array $world;

    /**
     * Default constructor.
     *
     * @param array $initialWorld The initial state of the world to instanciates.
     */
    public function __construct(array $initialWorld = []) {
        // Mapping each element of the initial world in a `Cell`
        $this->world = array_map(function ($state) {
            return new Cell($state);
        }, $initialWorld);
    }

    /**
     * Makes the world moves to its next step.
     *
     * @param int $nb_steps [optional] The number of steps of the world towards progression.
     * @return void
     */
    public function step(int $nb_steps = 1): void {
        for ($i = 0; $i < $nb_steps; ++$i) {
            // First, we'll send the messages between cells.
            array_walk($this->world, function (Cell $cell, $index) {
                // Computing array index and handling edge cases for the end and the beginning
                // of the array
                $left = $index - 1;
                if ($left < 0) {
                    $left = count($this->world) - 1;
                }

                $right = $index + 1;
                if ($right >= count($this->world)) {
                    $right = 0;
                }

                // Sending the messages to the neighbors.
                $cell->sendMessage($this->world[$left], $this->world[$right]);
            });

            // Then, we'll mutate each cells based on the messages they have received.
            foreach ($this->world as $cell) {
                $cell->nextState();
            }
        }
    }

    /**
     * Magic method to cast the world into a string.
     *
     * @return string
     */
    public function __toString(): string {
        return implode(",", $this->world);
    }
}
