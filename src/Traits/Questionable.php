<?php

namespace Payavel\Checkout\Traits;

trait Questionable
{
    /**
     * Ask for the name of the payment entity (provider, merchant, etc...) to be added.
     *
     * @param string $entity
     * @return string
     */
    protected function askName($entity)
    {
        return $this->ask("What subscription {$entity} would you like to add?");
    }

    /**
     * Ask for the id of the payment entity (provider, merchant, etc...) to be added.
     *
     * @param string $entity
     * @param string $name
     * @return string
     */
    protected function askId($entity, $name)
    {
        return $this->ask(
            "How would you like to identify the {$name} subscription {$entity}?",
            preg_replace('/[^a-z0-9]+/i', '_', strtolower($name))
        );
    }
}
