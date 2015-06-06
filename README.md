# PHP Cluster Manager

[![Build Status](https://travis-ci.org/petercoles/cluster-manager.svg?branch=master)](https://travis-ci.org/petercoles/cluster-manager)

Despite the goodness above, this project is at a very early stage of development, is missing key functionality and is not, yet, recommended for adoption.

It's aims are to provide a stepping stone for PHP projects expanding from a single server or new projects that will adopt a queue-driven clustered server architecture from the outset.

It's main features will be the ability to monitor queues and spin up (or down) worker servers to handle the queued jobs, as well as monitoring the health of the servers in the cluster and taking remedial action where needed.
