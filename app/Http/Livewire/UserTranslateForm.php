<?php

namespace App\Http\Livewire;

use GuzzleHttp\Client;
use Livewire\Component;

class UserTranslateForm extends Component
{
    public $userText;
    public $clientLang;
    public $userTranslatedText;
    public $lang_codes = [
        "BG" => "Bulgarian",
        "CS" => "Czech",
        "DA" => "Danish",
        "DE" => "German",
        "EL" => "Greek",
        "EN" => "English",
        "ES" => "Spanish",
        "ET" => "Estonian",
        "FI" => "Finnish",
        "FR" => "French",
        "HU" => "Hungarian",
        "ID" => "Indonesian",
        "IT" => "Italian",
        "JA" => "Japanese",
        "KO" => "Korean",
        "LT" => "Lithuanian",
        "LV" => "Latvian",
        "NB" => "Norwegian (Bokmål)",
        "NL" => "Dutch",
        "PL" => "Polish",
        "PT" => "Portuguese (all Portuguese varieties mixed)",
        "RO" => "Romanian",
        "RU" => "Russian",
        "SK" => "Slovak",
        "SL" => "Slovenian",
        "SV" => "Swedish",
        "TR" => "Turkish",
        "UK" => "Ukrainian",
        "ZH" => "Chinese"
    ];

    protected $listeners = ['sourceLangSent' => 'handleClientLang'];

    public function handleClientLang($clientData)
    {
        $this->clientLang = $clientData;
    }

    public function updatedUserText()
    {
        $this->userTranslatedText = '';
        $this->dispatchBrowserEvent('userStopTyping');
        $this->userTranslate();
    }

    public function userTranslate()
    {
        $client = new Client();

        $response = $client->request('POST', 'https://api-free.deepl.com/v2/translate', [
            'form_params' => [
                'auth_key' => env('DEEPL_API_KEY'),
                'text' => $this->userText,
                'target_lang' => $this->clientLang
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        $this->userTranslatedText = $data['translations'][0]['text'];
    }

    public function copyToClipboard()
{
    $this->dispatchBrowserEvent('textCopied');
}

    public function render()
    {
        return view('livewire.user-translate-form');
    }
}
