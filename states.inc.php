
<?php
require_once("modules/php/constants.inc.php");
/**
 *------
 * BGA framework: Gregory Isabelli & Emmanuel Colin & BoardGameArena
 * sausagesizzle implementation : © Russ King srussking@gmail.com
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * states.inc.php
 *
 * sausagesizzle game states description
 *
 */

/*
   Game state machine is a tool used to facilitate game developpement by doing common stuff that can be set up
   in a very easy way from this configuration file.

   Please check the BGA Studio presentation about game state to understand this, and associated documentation.

   Summary:

   States types:
   _ activeplayer: in this type of state, we expect some action from the active player.
   _ multipleactiveplayer: in this type of state, we expect some action from multiple players (the active players)
   _ game: this is an intermediary state where we don't expect any actions from players. Your game logic must decide what is the next game state.
   _ manager: special type for initial and final state

   Arguments of game states:
   _ name: the name of the GameState, in order you can recognize it on your own code.
   _ description: the description of the current game state is always displayed in the action status bar on
                  the top of the game. Most of the time this is useless for game state with "game" type.
   _ descriptionmyturn: the description of the current game state when it's your turn.
   _ type: defines the type of game states (activeplayer / multipleactiveplayer / game / manager)
   _ action: name of the method to call when this game state become the current game state. Usually, the
             action method is prefixed by "st" (ex: "stMyGameStateName").
   _ possibleactions: array that specify possible player actions on this step. It allows you to use "checkAction"
                      method on both client side (Javacript: this.checkAction) and server side (PHP: $this->checkAction).
   _ transitions: the transitions are the possible paths to go from a game state to another. You must name
                  transitions in order to use transition names in "nextState" PHP method, and use IDs to
                  specify the next game state for each transition.
   _ args: name of the method to call to retrieve arguments for this gamestate. Arguments are sent to the
           client side to be used on "onEnteringState" or to set arguments in the gamestate description.
   _ updateGameProgression: when specified, the game progression is updated (=> call to your getGameProgression
                            method).
*/

//    !! It is not a good idea to modify this file when a game is running !!


$machinestates = [

    // The initial state. Please do not modify.

    ST_BGA_GAME_SETUP => array(
      "name" => "gameSetup",
      "description" => clienttranslate("Game setup"),
      "type" => "manager",
      "action" => "stGameSetup",
      "transitions" => array( "" => ST_INITIAL_ROLL )
  ),

  ST_INITIAL_ROLL => [
    "name" => "initialDiceRoll",
    "description" => "",
    "type" => "game",
    "action" => "stInitialDiceRoll",
    "transitions" => [ 
        "" => ST_ROLL,
    ],
  ],
  
  ST_ROLL => array(
      "name" => "playerTurn",
      "description" => clienttranslate('${actplayer} must choose a die'),
      "descriptionmyturn" => clienttranslate('${you} must choose at least one die'),
      "type" => "activeplayer",
      "args" => "argPlayerTurn",
      "possibleactions" => array( 'lock', 'score' ),
      "transitions" => array( "lock" => ST_REROLL, "score" => ST_RESOLVE, "zombiePass" => ST_RESOLVE )
  ),
  ST_REROLL => array(
    "name" => "reRoll",
    "description" => clienttranslate('${actplayer} can re-roll remaining dice'),
    "descriptionmyturn" => clienttranslate('${you} can re-roll remaining dice'),
    "type" => "activeplayer",
    "args" => "argPlayerTurn",
    "possibleactions" => array( 'reRoll', 'score' ),
    "transitions" => array( "reRoll" => ST_ROLL, "score" => ST_RESOLVE, "zombiePass" => ST_RESOLVE )
  ),
  
  ST_RESOLVE => array(
      "name" => "resolve",
      "type" => "game",
      "action" => "stResolve",
      "updateGameProgression" => true,        
      "transitions" => array( "nextTurn" => ST_NEXT_PLAYER )
  ),
    
  ST_NEXT_PLAYER => array(
      "name" => "nextPlayer",
      "type" => "game",
      "action" => "stNextPlayer",
      "updateGameProgression" => true,        
      "transitions" => array( "nextTurn" => ST_INITIAL_ROLL, "endGame" => ST_END_GAME )
  ),
 
  ST_END_GAME => array(
      "name" => "gameEnd",
      "description" => clienttranslate("End of game"),
      "type" => "manager",
      "action" => "stGameEnd",
      "args" => "argGameEnd"
  )

];

