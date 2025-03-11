<?php

namespace CaiqueBispo\AiAgentsPhp\Class;

use CaiqueBispo\AiAgentsPhp\Agents\BaseAgent;

class TestAgent extends BaseAgent
{
    /**
     * @aiagent-description This is a test agent
     */
    public function whoame()
    {
        return 'TestAgent';
    }
}