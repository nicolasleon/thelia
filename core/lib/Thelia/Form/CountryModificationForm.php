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

namespace Thelia\Form;

use Symfony\Component\Validator\Constraints\GreaterThan;

class CountryModificationForm extends CountryCreationForm
{
    use StandardDescriptionFieldsTrait;

    protected function buildForm()
    {
        parent::buildForm(true);

        $this->formBuilder
            ->add("id", "hidden", array("constraints" => array(new GreaterThan(array('value' => 0)))))
        ;

        // Add standard description fields, excluding title and locale, which a re defined in parent class
        $this->addStandardDescFields(array('title', 'locale'));
    }

    public function getName()
    {
        return "thelia_country_modification";
    }
}
