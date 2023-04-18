<?php

namespace Payavel\Subscription\Contracts;

interface SubscriptionResponder
{
    /**
     * Maps details from the plans() response to the expected format.
     *
     * @return array|mixed
     */
    public function plansResponse();

    /**
     * Maps details from the listAgreements() response to the expected format.
     *
     * @return array|mixed
     */
    public function listAgreementsResponse();

    /**
     * Maps details from the getAgreement() response to the expected format.
     *
     * @return array|mixed
     */
    public function getAgreementResponse();

    /**
     * Maps details from the createAgreement() response to the expected format.
     *
     * @return array|mixed
     */
    public function createAgreementResponse();

    /**
     * Maps details from the updateAgreement() response to the expected format.
     *
     * @return array|mixed
     */
    public function updateAgreementResponse();

    /**
     * Maps details from the cancelAgreement() response to the expected format.
     *
     * @return array|mixed
     */
    public function cancelAgreementResponse();

    /**
     * Maps details from the activateAgreement() response to the expected format.
     *
     * @return array|mixed
     */
    public function activateAgreementResponse();
}
