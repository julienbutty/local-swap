<?php

namespace App\Tests\Application\DTO\User;

use App\Application\DTO\User\RegistrationData;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class RegistrationDataTest extends TestCase
{
    /**
     * @dataProvider registrationDataProvider
     */
    public function testRegistrationData($expectedViolationsCount, $data)
    {
        $registrationData = new RegistrationData();

        $registrationData->firstName = $data['firstName'];
        $registrationData->lastName = $data['lastName'];
        $registrationData->userName = $data['userName'];
        $registrationData->email = $data['email'];
        $registrationData->plainPassword = $data['plainPassword'];

        $validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();

        $violations = $validator->validate($registrationData);

        $this->assertCount($expectedViolationsCount, $violations);

    }
    
    public function registrationDataProvider(): array
    {
        return [
            'success' => [
                'expectedViolationsCount' => 0,
                'data' => [
                    'firstName' => 'John',
                    'lastName' => 'Doe',
                    'userName' => 'johndoe',
                    'email' => 'jd@mail.fr',
                    'plainPassword' => 'password'
                ]
            ],
            'all Failure' => [
                'expectedViolationsCount' => 5,
                'data' => [
                    'firstName' => '',
                    'lastName' => '',
                    'userName' => '',
                    'email' => '',
                    'plainPassword' => ''
                ]
            ],
            'firstName failure' => [
                'expectedViolationsCount' => 1,
                'data' => [
                    'firstName' => '',
                    'lastName' => 'Doe',
                    'userName' => 'johndoe',
                    'email' => 'jd@mail.fr',
                    'plainPassword' => 'password'
                ]
            ],
            'LastName failure' => [
                'expectedViolationsCount' => 1,
                'data' => [
                    'firstName' => 'John',
                    'lastName' => '',
                    'userName' => 'johndoe',
                    'email' => 'jd@mail.fr',
                    'plainPassword' => 'password'
                ]
            ],
            'username failure' => [
                'expectedViolationsCount' => 1,
                'data' => [
                    'firstName' => 'John',
                    'lastName' => 'Doe',
                    'userName' => '',
                    'email' => 'jd@mail.fr',
                    'plainPassword' => 'password'
                ]
            ],
            'email failure' => [
                'expectedViolationsCount' => 1,
                'data' => [
                    'firstName' => 'John',
                    'lastName' => 'Doe',
                    'userName' => 'johndoe',
                    'email' => '',
                    'plainPassword' => 'password'
                ]
            ],
            'password failure' => [
                'expectedViolationsCount' => 1,
                'data' => [
                    'firstName' => 'John',
                    'lastName' => 'Doe',
                    'userName' => 'johndoe',
                    'email' => 'jd@mail.fr',
                    'plainPassword' => ''
                ]
            ],
        ];
    }
}