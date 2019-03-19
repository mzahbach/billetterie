<?php

namespace App\Entity;



class PropertySearch
{
    

    /**
     * Undocumented variable
     *
     * @var string|null
     */
    private $titreSearch;

    

    public function getTitreSearch(): ?string
    {
        return $this->titreSearch;
    }

    public function setTitreSearch(?string $titreSearch): self
    {
        $this->titreSearch = $titreSearch;

        return $this;
    }
}
