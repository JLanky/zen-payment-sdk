<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Enum;

final class ValidationErrorMessages
{
    // General validation messages
    public const NOT_BLANK = 'This field is required';
    public const INVALID_EMAIL = 'Invalid email format';
    public const INVALID_IP = 'Invalid IP address format';
    public const INVALID_CURRENCY = 'Invalid currency code';
    public const INVALID_DATE = 'Date must be in YYYY-MM-DD format';
    public const INVALID_PHONE = 'Phone number must be in international format';
    public const INVALID_VERSION = 'Version must be in semantic versioning format (e.g., 1.0.0)';
    
    // Amount validation
    public const INVALID_AMOUNT_FORMAT = 'Amount must be a valid decimal number with up to 2 decimal places';
    public const AMOUNT_MUST_BE_POSITIVE = 'Amount must be positive';
    
    // String validation
    public const INVALID_ALPHANUMERIC = 'Must contain only alphanumeric characters, hyphens, and underscores';
    public const INVALID_LETTERS_AND_SPACES = 'Must contain only letters and spaces';
    public const INVALID_POSITIVE_INTEGER = 'Must be a positive integer';
    
    // Length validation
    public const STRING_TOO_SHORT = 'String is too short';
    public const STRING_TOO_LONG = 'String is too long';
    public const INVALID_LENGTH = 'Invalid length';
    
    // Choice validation
    public const INVALID_PAYMENT_CHANNEL = 'Invalid payment channel';
    public const INVALID_CHANNEL = 'Invalid channel';
    public const INVALID_ACCOUNT_AGE_INDICATOR = 'Invalid account age indicator';
    public const INVALID_ACCOUNT_CHANGE_INDICATOR = 'Invalid account change indicator';
    public const INVALID_PASSWORD_CHANGE_INDICATOR = 'Invalid password change indicator';
    public const INVALID_PAYMENT_ACCOUNT_INDICATOR = 'Invalid payment account indicator';
    public const INVALID_FEE_OWNER = 'Invalid fee owner';
    public const INVALID_TYPE = 'Invalid type';
    
    // Specific field messages
    public const MERCHANT_TRANSACTION_ID_INVALID = 'Merchant transaction ID must contain only alphanumeric characters, hyphens, and underscores';
    public const SESSION_ID_INVALID = 'Session ID must contain only alphanumeric characters, hyphens, and underscores';
    public const PLUGIN_NAME_INVALID = 'Plugin name must contain only alphanumeric characters, hyphens, and underscores';
    public const PLATFORM_NAME_INVALID = 'Platform name must contain only alphanumeric characters, hyphens, and underscores';
    public const CUSTOMER_ID_INVALID = 'Customer ID must contain only alphanumeric characters, hyphens, and underscores';
    public const USER_ID_INVALID = 'User ID must contain only alphanumeric characters, hyphens, and underscores';
    public const ACCOUNT_ID_INVALID = 'Account ID must contain only alphanumeric characters, hyphens, and underscores';
    public const FIRST_NAME_INVALID = 'First name must contain only letters and spaces';
    public const LAST_NAME_INVALID = 'Last name must contain only letters and spaces';
    public const TENANT_ID_MUST_BE_POSITIVE = 'Tenant ID must be positive';
    public const NUMBER_OF_PURCHASES_INVALID = 'Number of purchases must be a positive integer';
    public const PAYMENT_ACCOUNT_AGE_INVALID = 'Payment account age must be a positive integer';
    public const TRANSACTION_ACTIVITY_DAY_INVALID = 'Transaction activity day must be a positive integer';
    public const TRANSACTION_ACTIVITY_YEAR_INVALID = 'Transaction activity year must be a positive integer';
    public const ACCOUNT_CHANGE_DATE_INVALID = 'Account change date must be in YYYY-MM-DD format';
    public const ACCOUNT_CREATION_DATE_INVALID = 'Account creation date must be in YYYY-MM-DD format';
    public const PASSWORD_CHANGE_DATE_INVALID = 'Password change date must be in YYYY-MM-DD format';
}
