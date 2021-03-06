<?php
/*************************************************************************************/
/*      This file is part of the Thelia package.                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

namespace Thelia\Condition\Implementation;

/**
 * Check a Checkout against its Product number
 *
 * @package Condition
 * @author  Franck Allimant <franck@cqfdev.fr>
 *
 */
class MatchBillingCountries extends AbstractMatchCountries
{
    /**
     * @inheritdoc
     */
    public function getServiceId()
    {
        return 'thelia.condition.match_billing_countries';
    }

    /**
     * @inheritdoc
     */
    public function isMatching()
    {
        $billingAddress = $this->facade->getCustomer()->getDefaultAddress();

        return $this->conditionValidator->variableOpComparison(
            $billingAddress->getCountryId(),
            $this->operators[self::COUNTRIES_LIST],
            $this->values[self::COUNTRIES_LIST]
        );
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->translator->trans(
            'Billing country',
            [],
            'condition'
        );
    }

    /**
     * @inheritdoc
     */
    public function getToolTip()
    {
        $toolTip = $this->translator->trans(
            'The coupon applies to the selected delivery countries',
            [],
            'condition'
        );

        return $toolTip;
    }

    protected function getSummaryLabel($cntryStrList, $i18nOperator) {

        return $this->translator->trans(
            'Only if order billing country is %op% <strong>%countries_list%</strong>', [
                '%countries_list%' => $cntryStrList,
                '%op%' => $i18nOperator
            ], 'condition'
        );
    }

    protected function getFormLabel() {
        return $this->translator->trans(
            'Billing coutry is', [], 'condition'
        );
    }
}
