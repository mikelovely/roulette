# Roulette Simulator
## Description
This is a pretty basic Roulette simulator with the intend to practice my OOP and SOLID principles.

## To install
```
composer install
```

## To run the simulation
```
php simulate run:simulation
```

## Adding Players
At the moment, Players must be added manually via the [SimulationController.php](https://github.com/mikelovely/roulette/blob/master/app/Controllers/SimulationController.php#L20) file.

To define a Player, you must pass three arguments when instantiating a Player
 - A "Strategy". Either "[Martingale](https://en.wikipedia.org/wiki/Martingale_(betting_system))" or "None"
 - A initial amount. The "Stack". eg `1000`
 - A playing "Style". Options are "aggressive" or "cautious". Bet amounts will be adjusted accordingly

## How it works
### How does a Player win?
The only way a Player can win is if he/she has (currently) at least 5 times the amount of their initial stake. If this happens, the Player will walk away from the table.

### Martin-what?!
If a Player is playing the [Martingale](https://en.wikipedia.org/wiki/Martingale_(betting_system)) strategy then they can only bet on even-money outside bets (eg Red or Black). If they lose the round, the Player will bet exactly double the previous bet just lost. If they lose again, they will bet double again.. and so on and so on.. until either they win a round and start again or they lose all their money.

### Neighbour bets (section betting)
A [section bet](http://www.outsidebet.net/roulette-neighbour-section-bets-how-to/) is a sub-set of the Straight Up bet type. It was pretty fun to implement.
