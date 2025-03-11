<?php

namespace App\Entity;

use App\Repository\TrackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrackRepository::class)]
class Track
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $duration = null;

    /**
     * @var Collection<int, Artist>
     */
    #[ORM\ManyToMany(targetEntity: Artist::class, mappedBy: 'featuredIn')]
    private Collection $featureArtists;

    #[ORM\ManyToOne(inversedBy: 'tracks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Release $release = null;

    #[ORM\ManyToOne(inversedBy: 'tracks')]
    #[ORM\JoinColumn(nullable: false, options: ['default' => 2])]
    private ?user $owner = null;

    public function __construct()
    {
        $this->featureArtists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }
    
    public function getReadableDuration(): string
    {
        $duration = $this->getDuration();
        $moreThanOneHour = $duration >= (60 * 60);

        return gmdate(
            $moreThanOneHour ? 'G:i:s' : 'i:s',
            $duration
        );
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }


    /**
     * @return Collection<int, Artist>
     */
    public function getFeatureArtists(): Collection
    {
        return $this->featureArtists;
    }

    public function addFeatureArtist(Artist $featureArtist): static
    {
        if (!$this->featureArtists->contains($featureArtist)) {
            $this->featureArtists->add($featureArtist);
            $featureArtist->addFeaturedIn($this);
        }

        return $this;
    }

    public function removeFeatureArtist(Artist $featureArtist): static
    {
        if ($this->featureArtists->removeElement($featureArtist)) {
            $featureArtist->removeFeaturedIn($this);
        }

        return $this;
    }

    public function getRelease(): ?Release
    {
        return $this->release;
    }

    public function setRelease(?Release $release): static
    {
        $this->release = $release;

        return $this;
    }

    public function getOwner(): ?user
    {
        return $this->owner;
    }

    public function setOwner(?user $owner): static
    {
        $this->owner = $owner;

        return $this;
    }
}