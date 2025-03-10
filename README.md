# 🔧 Setup

### Prerequisites

Make sure you have the `phpdotenv` package installed. You can install it via Composer:

```bash
composer require vlucas/phpdotenv
```

### Configuring the `.env` file

In the root of your project, create a file named `.env` with the following variables:

```dotenv
ANTHROPIC_KEY=xxx

AZURE_OPENAI_KEY="mykey"
AZURE_OPENAI_API_VERSION="2023-09-01-preview"
AZURE_OPENAI_DOMAIN="mydomain"
AZURE_OPENAI_DEPLOYMENT="deployment_name"

OPENAI_API_KEY="sk-abcdefg"

OPEN_WEATHER_MAP_API_KEY="asdfjkl"

TWILIO_ACCOUNT_SID="asdf"
TWILIO_AUTH_TOKEN="asdf"
TWILIO_PHONE_NUMBER="+12345678901"


```

### Installation

Install the package via Composer:

```bash
composer require caiquebispo/ai-agents-php
```

### In Code

```php
$chat = new \CaiqueBispo\AiAgentsPHP\ChatModels\ChatGPT();
// or
$chat = new \CaiqueBispo\AiAgentsPHP\ChatModels\AzureOpenAI();
// or
$chat = new \CaiqueBispo\AiAgentsPHP\ChatModels\AnthropicClaude();

$agent = new \CaiqueBispo\AiAgentsPHP\Agents\TestingAgent($chat); // Ensures the agent receives a pre-prompt upon creation
$agent->ask("Hello, is this working?"); // Yes, I am here. How can I help you today?
$agent->lastCallMetadata;
/*
return $agent->lastCallMetadata;
= [
    "id" => "chatcmpl-8123ABC",
    "created" => 1705545737,
    "model" => "gpt-4",
    "systemFingerprint" => "fp_l33t123",
    "usage" => OpenAI\Responses\Chat\CreateResponseUsage {#5004
      +promptTokens: 365,
      +completionTokens: 17,
      +totalTokens: 382,
    },
  ]
*/
```

## 🤖 Creating a new agent
To create a new agent, you must extend the `BaseAgent` class and define any additional functionality.

**NOTE: If you want your agent to always call a function, you can extend the `FunctionsAgent` instead!**

The `prePrompt` property is the pre-prompt that is passed to the chat model. This should describe how you want the agent to think and act.

You can use traits in `AgentTraits` to add specific functionalities that you may need.

For example, if you want your agent to be able to send text messages, you can add the `SMSTrait` to your agent class. The bot will automatically know that it can send text messages.

This is an example of an agent that can send text messages, perform calculations, and get the weather forecast.

**This is the total code needed to create an agent.**
```php
class TestingAgent extends BaseAgent {

    use \CaiqueBispo\AiAgentsPHP\AgentTraits\SMSTrait; // Access to send SMS via Twilio
    use \CaiqueBispo\AiAgentsPHP\AgentTraits\MathTrait; // Access to math functions
    use \CaiqueBispo\AiAgentsPHP\AgentTraits\DateTrait;  // Access to date functions
    use \CaiqueBispo\AiAgentsPHP\AgentTraits\WeatherTrait; // Access to openweathermap API

    public string $prePrompt = "You are a helpful assistant";   // Pre-prompt
}
```

### Defining an agent function
To define an agent function, you must follow the PHP DocBlock to describe the parameters, return type, and method.

For the agent to have access to the function, you must include an additional parameter in the PHPDoc block called `@aiagent-description`. This should be a string that describes the function. Any functions that include this property in the agent class will be automatically made available to the agent.

Example of the `add` function:
```php
    /**
     * @param int $a
     * @param int $b
     * @return int
     * @aiagent-description Adds two numbers
     */
    public function add(int $a, int $b): int {
        return $a + $b;
    }
```

## 🧰 Agent Traits
Agent Traits can be used to add functionalities to an agent. Some are included in this package under the `AgentTraits` namespace.

`DateTrait` - Provides access to date functions (e.g., `compareDates` or `getCurrentDate`)

It is highly recommended that you place reusable functions in a trait and then add that trait to your agent.

## 📝 Chat Models

### Currently Supported
- GPT-3.5-turbo
- GPT-4
- Azure OpenAI
- Anthropic Claude

### Adding a new chat model
New models can be added by extending the `AbstractChatModel` class. This class provides the basic functionality needed to interact with the chat model.

## ❤️ Contributing
Opening new issues is encouraged if you have any questions, problems, or ideas.

Pull requests are also welcome!

[See our contribution guide](CONTRIBUTING.md)
