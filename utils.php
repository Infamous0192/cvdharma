<?php

class Session
{
    public static function start()
    {
        session_start();
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    public static function retrive($key, $default = null)
    {
        if (!isset($_SESSION[$key])) return $default;

        $value = $_SESSION[$key];
        unset($_SESSION[$key]);

        return $value;
    }

    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    public static function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public static function destroy()
    {
        session_unset();
        session_destroy();
    }
}


class Redirect
{
    public static function to($url)
    {
        header("Location: " . Router::baseUrl($url));
        exit();
    }

    public static function back()
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? Router::baseUrl();
        self::to($referer);
    }

    public static function withMessage($name, $message)
    {
        Session::set($name, $message);
        return new self();
    }
}

class FileUpload
{
    public static function upload($name, $targetDirectory = 'uploads/')
    {
        if (!isset($_FILES[$name])) {
            return [
                'success' => false,
                'error' => 'No file was uploaded.',
            ];
        }

        $file = $_FILES[$name];

        if ($file['error'] === UPLOAD_ERR_OK) {
            $fileName = self::generateUniqueFileName($file['name']);
            $fileTmpPath = $file['tmp_name'];
            $targetFilePath = $targetDirectory . $fileName;

            if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
                $uploadedFile = [
                    'success' => true,
                    'name' => $fileName,
                    'type' => $file['type'],
                    'size' => $file['size'],
                    'path' => $targetFilePath,
                ];

                return $uploadedFile;
            } else {
                return [
                    'success' => false,
                    'error' => 'Failed to move the uploaded file.',
                ];
            }
        } else {
            return [
                'success' => false,
                'error' => 'Error uploading the file: ' . self::getErrorMessage($file['error']),
            ];
        }
    }

    private static function generateUniqueFileName($fileName)
    {
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $uniqueName = uniqid() . '.' . $extension;

        return $uniqueName;
    }

    private static function getErrorMessage($errorCode)
    {
        switch ($errorCode) {
            case UPLOAD_ERR_INI_SIZE:
                return 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
            case UPLOAD_ERR_FORM_SIZE:
                return 'The uploaded file exceeds the MAX_FILE_SIZE directive specified in the HTML form.';
            case UPLOAD_ERR_PARTIAL:
                return 'The uploaded file was only partially uploaded.';
            case UPLOAD_ERR_NO_FILE:
                return 'No file was uploaded.';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Missing a temporary folder.';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Failed to write file to disk.';
            case UPLOAD_ERR_EXTENSION:
                return 'A PHP extension stopped the file upload.';
            default:
                return 'Unknown error occurred.';
        }
    }
}
