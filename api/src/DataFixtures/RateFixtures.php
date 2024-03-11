<?php

namespace App\DataFixtures;

use App\Entity\Rate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RateFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $currencies = ['USD', 'EUR', 'GBP', 'JPY', 'CAD', 'AUD', 'CHF', 'CNY', 'INR', 'NZD'];

        foreach ($currencies as $currency) {
            for ($i = 0; $i < 100; $i++) {
                $rate = $this->createRate($currency);
                $manager->persist($rate);
            }
        }

        $manager->flush();
    }

    private function createRate(string $currency): Rate
    {
        $timestamp = mt_rand(946684800, time());
        $rates = [];
        $currencies = ['USD', 'EUR', 'GBP', 'JPY', 'CAD', 'AUD', 'CHF', 'CNY', 'INR', 'NZD'];

        foreach ($currencies as $cur) {
            $rates[$cur] = mt_rand(1, 1000) / 100;
        }

        $rate = new Rate();
        $rate->setLastUpdate($timestamp);
        $rate->setBase($currency);
        $rate->setRates($rates);

        return $rate;
    }
}
