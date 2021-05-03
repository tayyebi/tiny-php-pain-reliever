<?php

/**
 * 
 * Custom Execption Types
 * 
 */
// HTTP 400
class BadRequestException extends Exception{ }
// HTTP 401
class UnauthException extends Exception{ }
// HTTP 403
class AuthException extends Exception{ }
// HTTP 404
class NotFoundException extends Exception{ }
// HTTP 405
class MethodNotAllowedException extends Exception{ }