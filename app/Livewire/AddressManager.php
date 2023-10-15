<?php

namespace App\Livewire;

use App\Enuns\BrazilStates;
use App\Models\Address;
use Livewire\Component;

class AddressManager extends Component
{
    public string $addressName;
    public string $cep;
    public string $city;
    public string $state;
    public string $number;
    public string $complement;
    public string $street;
    public string $neighborhood;

    public string $viewMode = "manage";

    public function searchAddress($cep): void
    {
        $cepData = json_decode(file_get_contents("https://viacep.com.br/ws/{$cep}/json/"));
        if (!$cepData || isset($cepData->erro)) {

            return;
        }

        $this->cep = $cepData->cep;
        $this->city = $cepData->localidade;
        $this->state = strtoupper($cepData->uf);
        $this->complement = $cepData->complemento;
        $this->street = $cepData->logradouro;
        $this->neighborhood = $cepData->bairro;

        $this->viewMode = "show-results";
    }

    public function render()
    {
        return view('livewire.address-manager', [
            "addresses" => auth()->user()->addresses
        ]);
    }

    public function save()
    {
        $userAddresses = auth()->user()->addresses();
        $userAddresses->update([
            "active" => false
        ]);
        $userAddresses->create([
            'zip_code' => $this->addressName,
            'name' => $this->addressName,
            'street' => $this->street,
            'neighborhood' => $this->neighborhood,
            'number' => empty($this->number) ? "s/n" : $this->number,
            'complement' => $this->complement,
            'city' => $this->city,
            'state' => BrazilStates::from($this->state),
            'active' => true,
        ]);

        $this->viewMode = 'manage';
    }

    public function changeActiveAddress(int $addressId)
    {
        auth()->user()->addresses()->update([
            "active" => false
        ]);
        auth()->user()->addresses()->whereId($addressId)->update([
            "active" => true
        ]);
    }
}
