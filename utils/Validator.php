<?php

class Validator
{
    public array $errors = [];

    public static function validate(array $rules, array $data): Validator
    {
        $validator = new self();

        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                if (str_contains($rule, ':')) {
                    [$rule, $ruleArg] = explode(':', $rule);
                    $validator->applyRule($rule, $field, $data[$field] ?? null, $ruleArg);
                } else if ($rule == 'confirmed') {
                    $confirmationField = $field . '_confirmation';
                    $validator->confirmed($field, $data[$field] ?? null, $data[$confirmationField] ?? null);
                }else {
                    $validator->applyRule($rule, $field, $data[$field] ?? null);
                }
            }
        }

        return $validator;
    }

    private function required($field, $value): void
    {
        if (empty(trim($value))) {
            $this->errors[] = "$field is required";
        }
    }

    private function email($field, $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "$field should be a valid email address";
        }
    }

    private function confirmed($field, $value, $valueConfirmation): void
    {
        if ($value !== $valueConfirmation) {
            $this->errors[] = "$field must match the confirmation value.";
        }
    }

    private function min($field, $value, $min): void
    {
        if (strlen($value) < $min) {
            $this->errors[] = "$field must contain at least $min characters.";
        }
    }

    private function strong($field, $value): void
    {
        $specialChars = "!#$%&'()*+,-./:;\"<=>?@[\]^_`{|}~";

        $hasSpecialChars = strpbrk($value, $specialChars) !== false;
        $hasUpper = preg_match('/[A-Z]/', $value) === 1; // if find something return 1, hence true
        $hasLower = preg_match('/[a-z]/', $value) === 1;
        $hasNumber = preg_match('/[0-9]/', $value) === 1;

        if (!$hasSpecialChars || !$hasUpper || !$hasLower || !$hasNumber) {
            $this->errors[] = "$field must contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
        }
    }

    private function unique($field, $value, $table): void
    {
        if (strlen($value) === 0) return;

        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("SELECT * FROM $table WHERE $field = :value");
        $stmt->execute(['value' => $value]);
        $result = $stmt->fetchAll();

        if ($result) {
            $this->errors[] = "$field already exists.";
        }
    }

    public function fails(): bool
    {
        $_SESSION['errors'] = $this->errors;
        return !empty($this->errors);
    }

    private function applyRule($rule, $field, $value, $ruleArg = null): void
    {
        if (method_exists($this, $rule)) {
            $this->$rule($field, $value, $ruleArg);
        }
    }
}
