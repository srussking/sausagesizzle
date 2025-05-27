<?php
namespace SausageSizzle\Objects;

class Dice {
    public int $id;
    public int $value; // [croc, echi etc] for critter, [sausage 2 3 4 5 sausage] for food
    public bool $locked;
    public bool $rolled;
    public int $type;
    public bool $canReroll = true;

    public function __construct($dbDice) {
        $this->id = intval($dbDice['dice_id']);
        $this->value = intval($dbDice['dice_value']);
        $this->locked = boolval($dbDice['locked']);
        $this->rolled = boolval($dbDice['rolled']);
        $this->type = array_key_exists('type', $dbDice) ? intval($dbDice['type']) : 0;
    } 


}
?>
