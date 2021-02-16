<?php
use PHPUnit\Framework\TestCase;
use ExcitedCells\Cell;

class CellTest extends TestCase {
    public function testItInstanciatesACell(): void {
        $this->assertEquals('0', new Cell());
        $this->assertEquals('0', new Cell(false));
        $this->assertEquals('1', new Cell(true));
        $this->assertEquals('1', new Cell(1));
        $this->assertEquals('0', new Cell(0));
    }

    public function testCellIsExcitedOrNot(): void {
        $this->assertTrue((new Cell(true))->isExcited());
        $this->assertFalse((new Cell(false))->isExcited());
    }

    public function testCellCanReceiveAMessage(): void {
        $cell = new Cell();

        $this->assertEquals(0, $cell->getMessagesReceived());
        $cell->receiveMessage();
        $this->assertEquals(1, $cell->getMessagesReceived());
        $cell->receiveMessage();
        $this->assertEquals(2, $cell->getMessagesReceived());
        $cell->receiveMessage();
        $this->assertEquals(2, $cell->getMessagesReceived());
    }

    public function testCellIsSendingMessage(): void {
        $left = new Cell();
        $right = new Cell();
        $cell = new Cell(true);

        $cell->sendMessage($left, $right);
        $this->assertTrue($left->hasReceivedMessages());
        $this->assertTrue($right->hasReceivedMessages());
    }

    public function testCellIsTransitionningToNextState(): void {
        $left = new Cell(true);
        $right = new Cell(true);

        // Quiet cells is quiet if no message is received
        $cell = new Cell();
        $cell->nextState();
        $this->assertEquals('0', $cell);

        // Quiet cells become excited if only one message is received
        $cell = new Cell();
        $left->sendMessage(null, $cell);
        $cell->nextState();
        $this->assertEquals('1', $cell);

        $cell = new Cell();
        $right->sendMessage($cell, null);
        $cell->nextState();
        $this->assertEquals('1', $cell);

        // Cells become quiet if two messages are received
        $cell = new Cell();
        $left->sendMessage(null, $cell);
        $right->sendMessage($cell, null);
        $cell->nextState();
        $this->assertEquals('0', $cell);

        $cell = new Cell(true);
        $left->sendMessage(null, $cell);
        $right->sendMessage($cell, null);
        $cell->nextState();
        $this->assertEquals('0', $cell);

        // Excited cells become quiet if no messages are received
        $cell = new Cell(true);
        $cell->nextState();
        $this->assertEquals('0', $cell);
    }
}
