# PHP Cluster Manager

[![Build Status](https://travis-ci.org/petercoles/cluster-manager.svg?branch=master)](https://travis-ci.org/petercoles/cluster-manager)
[![Code Quality](https://scrutinizer-ci.com/g/petercoles/cluster-manager/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/petercoles/cluster-manager/?branch=master)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

Despite the goodness above, this project is at a very early stage of development, is missing key functionality and is not, yet, recommended for adoption.

It's aims are to provide a stepping stone for PHP projects expanding from a single server or new projects that will adopt a queue-driven clustered server architecture from the outset.

It's main features will be the ability to monitor queues and spin up (or down) worker servers to handle the queued jobs, as well as monitoring the health of the servers in the cluster and taking remedial action where needed.
