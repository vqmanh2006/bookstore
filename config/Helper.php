<?php
class Helper
{
    public static function UploadImage($fieldName)
    {
        if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
            return '';
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $mimeType = mime_content_type($_FILES[$fieldName]['tmp_name']);
        if (!in_array($mimeType, $allowedTypes, true)) {
            return '';
        }

        $uploadDirectory = dirname(__DIR__) . '/uploads';
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        $extension = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
        $extension = strtolower(preg_replace('/[^a-z0-9]/i', '', $extension));
        $fileName = uniqid('img_', true) . ($extension !== '' ? '.' . $extension : '');
        $targetPath = $uploadDirectory . '/' . $fileName;

        if (!move_uploaded_file($_FILES[$fieldName]['tmp_name'], $targetPath)) {
            return '';
        }

        return '/uploads/' . $fileName;
    }

    public static function Currency($value)
    {
        return number_format($value, 0, ',', '.') . ' ₫';
    }

    public static function Phone($str)
    {
        if (strlen($str) == 11) {
            return substr($str, 0, 5) . ' ' . substr($str, 5, 3) . ' ' . substr($str, 8, 3);
        } else if (strlen($str) == 10) {
            return substr($str, 0, 4) . ' ' . substr($str, 4, 3) . ' ' . substr($str, 7, 3);
        }
        return '';
    }

    public static function Date($str)
    {
        return date('d/m/Y', strtotime($str));
    }

    public static function DateTime($str)
    {
        return date('d/m/Y H:i:s', strtotime($str));
    }

    public static function StatusBadge($value)
    {
        return $value == 1 ? "<span class='badge badge-success'>Hoạt động</span>" : "<span class='badge badge-danger'>Khóa</span>";
    }

    public static function PaymentBadge($value)
    {
        if ($value == 1) {
            return "<span class='badge badge-success'>Đã thanh toán</span>";
        }
        if ($value == 2) {
            return "<span class='badge badge-danger'>Đã hủy</span>";
        }
        return "<span class='badge badge-warning'>Chưa thanh toán</span>";
    }

    public static function AccountTypeBadge($value)
    {
        if ($value == 1) {
            return "<span class='badge badge-success'>Quản trị viên</span>";
        } else if ($value == 2) {
            return "<span class='badge badge-info'>Nhân viên</span>";
        } else {
            return "<span class='badge badge-dark'>Thành viên</span>";
        }
    }
}
