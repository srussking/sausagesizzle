<?php

/*
 * State constants
 */
const ST_BGA_GAME_SETUP = 1;

const ST_INITIAL_ROLL = 10;
const ST_ROLL = 11;
const ST_REROLL = 12;
const ST_RESOLVE = 15;
const ST_NEXT_PLAYER = 20;
const ST_END_GAME = 99;

const CRITTERS = [
    ['id' => 0, 'name' => 'crocodile'],
    ['id' => 1, 'name' => 'echidna'],
    ['id' => 2, 'name' => 'kangaroo'],
    ['id' => 3, 'name' => 'platypus'],
    ['id' => 4, 'name' => 'quikka'],
    ['id' => 5, 'name' => 'tiger_snake'],
];




?>