<?php

$app->get('/simulate', [
    'Roulette\Controllers\SimulationController', 'index'
])->setName('simulate');
