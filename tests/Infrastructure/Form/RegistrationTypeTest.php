<?php

namespace App\Tests\Infrastructure\Form;

use App\Application\DTO\RegistrationData;
use App\Infrastructure\Form\Type\RegistrationType;
use Symfony\Component\Form\Test\TypeTestCase;

class RegistrationTypeTest extends TypeTestCase
{
    private array $formData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->formData = [
            'firstName' => 'Scoo',
            'lastName' => 'Bidoo',
            'userName' => 'ScooBidoo',
            'email' => 'scoo@bi.doo',
            'plainPassword' => [
                'first' => 'samy',
                'second' => 'samy',
            ],
            'submit' => 'Créer'
        ];
    }

    public function testSubmitedData()
    {

        $form = $this->factory->create(RegistrationType::class);

        $expectedDto = new RegistrationData();

        $expectedDto->firstName = 'Scoo';
        $expectedDto->lastName = 'Bidoo';
        $expectedDto->userName = 'ScooBidoo';
        $expectedDto->email = 'scoo@bi.doo';
        $expectedDto->plainPassword = 'samy';

        $form->submit($this->formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($expectedDto, $form->getData());
    }

    public function testAllFieldsAreTested()
    {
        $form = $this->factory->create(RegistrationType::class);

        $formView = $form->createView();
        $fields = array_keys($formView->children);

        $this->assertEquals(array_keys($this->formData), $fields, 'Some fields are missing in the tests');
    }
}
