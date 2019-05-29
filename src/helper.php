<?php

namespace App\Helper;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\ConstraintViolation;

/**
 * Extracts errors from form as an array.
 *
 * @param FormInterface $form
 *
 * @return array
 */
function extractConstraintViolationListFormForm(FormInterface $form): array
{
    $errors = [];

    foreach ($form->getErrors() as $error) {
        $errors[] = new ConstraintViolation(
            $error->getMessage(),
            $error->getMessage(),
            [],
            null,
            getPropertyPathForForm($form),
            null
        );
    }

    foreach ($form->all() as $childForm) {
        if ($childForm instanceof FormInterface) {
            if ($childErrors = extractConstraintViolationListFormForm($childForm)) {
                $errors = array_merge($errors, $childErrors);
            }
        }
    }

    return $errors;
}


function getPropertyPathForForm(FormInterface $form): string
{
    $name = $form->getName();

    if (!is_null($form->getParent())) {
        if (is_numeric($name)) {
            $propertyPath = getPropertyPathForForm($form->getParent()) . '[' . $name . ']';
        } else {
            $propertyPath = getPropertyPathForForm($form->getParent()) . '.' . $name;
        }
    } else {
        $propertyPath = 'root';
    }

    return $propertyPath;
}


