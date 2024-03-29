<?php

namespace Payavel\Subscription\Traits;

use Exception;
use Payavel\Serviceable\Traits\ThrowsRuntimeException;
use RuntimeException;

trait SubscriptionResponses
{
    use ThrowsRuntimeException;

    /**
     * Maps details from the plans() response to the expected format.
     *
     * @return array|mixed
     */
    public function plansResponse()
    {
        return $this->genericResponse(__FUNCTION__);
    }

    /**
     * Maps details from the listAgreements() response to the expected format.
     *
     * @return array|mixed
     */
    public function listAgreementsResponse()
    {
        return $this->genericResponse(__FUNCTION__);
    }

    /**
     * Maps details from the getAgreement() response to the expected format.
     *
     * @return array|mixed
     */
    public function getAgreementResponse()
    {
        return $this->genericResponse(__FUNCTION__);
    }

    /**
     * Maps details from the createAgreement() response to the expected format.
     *
     * @return array|mixed
     */
    public function createAgreementResponse()
    {
        return $this->genericResponse(__FUNCTION__);
    }

    /**
     * Maps details from the updateAgreement() response to the expected format.
     *
     * @return array|mixed
     */
    public function updateAgreementResponse()
    {
        return $this->genericResponse(__FUNCTION__);
    }

    /**
     * Maps details from the cancelAgreement() response to the expected format.
     *
     * @return array|mixed
     */
    public function cancelAgreementResponse()
    {
        return $this->genericResponse(__FUNCTION__);
    }

    /**
     * Maps details from the activateAgreement() response to the expected format.
     *
     * @return array|mixed
     */
    public function activateAgreementResponse()
    {
        return $this->genericResponse(__FUNCTION__);
    }

    /**
     * Attempts to call the generic response method, else throws RuntimeException.
     *
     * @param string $function
     * @return array|mixed
     *
     * @throws \RuntimeException|Exception
     */
    private function genericResponse($function)
    {
        try {
            return $this->response();
        } catch (Exception $e) {
            if ($e instanceof RuntimeException) {
                $this->throwRuntimeException($function);
            }

            throw($e);
        }
    }

    /**
     * The generic payment request response.
     *
     * @throws \RuntimeException
     */
    public function response()
    {
        return $this->throwRuntimeException(__FUNCTION__);
    }
}
