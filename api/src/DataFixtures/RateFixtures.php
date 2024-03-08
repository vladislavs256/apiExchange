<?php

namespace App\DataFixtures;

use App\Entity\Rate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RateFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 100; $i++) {

            $timestamp = mt_rand(946684800, time());

            $currencies = ['USD', 'EUR', 'GBP', 'JPY', 'CAD', 'AUD', 'CHF', 'CNY', 'INR', 'NZD'];

            $rates = [];
            foreach ($currencies as $currency) {
                $rates[$currency] = mt_rand(1, 1000) / 100;
            }

            $rate = new Rate();
            $rate->setLastUpdate($timestamp);
            $rate->setBase('EUR');
            $rate->setRates($rates);

            $manager->persist($rate);
        }

        $manager->flush();
    }
}
