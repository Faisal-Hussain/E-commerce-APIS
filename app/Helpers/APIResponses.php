<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

/**
 * Send a success response.
 *
 * @param  string  $message
 * @param  array   $data
 * @param  int     $statusCode
 * @return \Illuminate\Http\JsonResponse
 */
function sendSuccessResponse( $data = [])
{
    return response()->json([
        'success' => true,
        'message' => 'success',
        'data' => $data,
    ],  JsonResponse::HTTP_OK);
}

/**
 * Send a created response.
 *
 * @param  string  $message
 * @param  array   $data
 * @return \Illuminate\Http\JsonResponse
 */
function sendCreatedResponse($message = 'Resource created successfully', $data = [])
{
    return sendSuccessResponse($message, $data, JsonResponse::HTTP_CREATED);
}

/**
 * Send an updated response.
 *
 * @param  string  $message
 * @param  array   $data
 * @return \Illuminate\Http\JsonResponse
 */
function sendUpdatedResponse($message = 'Resource updated successfully', $data = [])
{
    return sendSuccessResponse($message, $data);
}

/**
 * Send a deleted response.
 *
 * @param  string  $message
 * @return \Illuminate\Http\JsonResponse
 */
function sendDeletedResponse($message = 'Resource deleted successfully')
{
    return sendSuccessResponse($message, [], JsonResponse::HTTP_NO_CONTENT);
}

/**
 * Send a default success response.
 *
 * @param  string  $message
 * @return \Illuminate\Http\JsonResponse
 */
function sendDefaultSuccessResponse($message = 'Success')
{
    return sendSuccessResponse($message);
}

/**
 * Send a bad request response.
 *
 * @param  string  $message
 * @param  array   $errors
 * @return \Illuminate\Http\JsonResponse
 */
function sendBadRequestResponse($message = 'Bad Request', $errors = [])
{
    return sendErrorResponse($message, JsonResponse::HTTP_BAD_REQUEST, $errors);
}

/**
 * Send an error response.
 *
 * @param  string  $message
 * @param  int     $statusCode
 * @param  array   $errors
 * @return \Illuminate\Http\JsonResponse
 */
function sendErrorResponse($message = 'Error', $statusCode = JsonResponse::HTTP_BAD_REQUEST, $errors = [])
{
    return response()->json([
        'success' => false,
        'message' => $message,
        'errors' => $errors,
    ], $statusCode);
}

/**
 * Send a not found response.
 *
 * @param  string  $message
 * @return \Illuminate\Http\JsonResponse
 */
function sendNotFoundResponse($message = 'Not Found')
{
    return sendErrorResponse($message, JsonResponse::HTTP_NOT_FOUND);
}

/**
 * Send an unauthorized response.
 *
 * @param  string  $message
 * @return \Illuminate\Http\JsonResponse
 */
function sendUnauthorizedResponse($message = 'Unauthorized')
{
    return sendErrorResponse($message, JsonResponse::HTTP_UNAUTHORIZED);
}

/**
 * Handle validation error response.
 *
 * @param  \Illuminate\Validation\ValidationException  $exception
 * @return \Illuminate\Http\JsonResponse
 */


function handleValidationErrors($message = 'Error', $statusCode = JsonResponse::HTTP_UNAUTHORIZED, $errors = [])
{
    return response()->json([
        'success' => false,
        'message' => $message,
        'errors' => $errors,
    ], $statusCode);
}
