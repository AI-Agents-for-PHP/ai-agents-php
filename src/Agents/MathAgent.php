<?php

namespace CaiqueBispo\AiAgentsPhp\Agents;

class MathAgent extends BaseAgent {

    use \CaiqueBispo\AiAgentsPhp\AgentTraits\MathTrait;

    public $prePrompt = "You are a helpful assistant with a specailization in math.";    

}