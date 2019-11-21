<?php

/**
 * バリデーションクラスです。
 */
class validationUtil
{
    /**
     * 名前の妥当性をチェックします。
     *
     * @param string $name 名前
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidName($name, &$msg): bool
    {
        $msg = '';
        if (empty($name)) {
            $msg = "お名前を入力してください。";
            return false;
        }
        if (strlen($name) > 50) {
            $msg = "恐れ入りますが、お名前は50文字以内でご入力ください。";
            return false;
        }
        return true;
    }


    /**
     * 郵便番号の妥当性をチェックします。
     *
     * @param string $postalCode 郵便番号
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidPostalCode($postalCode, &$msg): bool
    {
        $msg = '';
        if (empty($postalCode)) {
            $msg = "郵便番号を入力してください。";
            return false;
        }
        if (!preg_match('/^[0-9]{3}-?[0-9]{4}$/', $postalCode)) {
            $msg = "郵便番号は半角数字と半角ハイフンで入力してください。";
            return false;
        }
        return true;
    }


    /**
     * 都道府県の妥当性をチェックします。
     *
     * @param string $pref 都道府県
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidPref($pref, &$msg): bool
    {
        $msg = '';
        if (empty($pref)) {
            $msg = "都道府県を選択してください。";
            return false;
        }
        return true;
    }


    /**
     * 市区町村の妥当性をチェックします。
     *
     * @param string $addr 市区町村
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidAddress1($addr, &$msg): bool
    {
        $msg = '';
        if (empty($addr)) {
            $msg = "市区町村を入力してください。";
            return false;
        }
        if (strlen($addr) > 50) {
            $msg = "恐れ入りますが、市区町村は50文字以内で入力してください。";
            return false;
        }
        return true;
    }


    /**
     * 町名番地等の妥当性をチェックします。
     *
     * @param string $addr 町名番地等
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidAddress2($addr, &$msg): bool
    {
        $msg = '';
        if (empty($addr)) {
            $_SESSION['err_msg']['address2'] = "町名番地等を入力してください。";
            return false;
        }
        if (strlen($addr) > 50) {
            $_SESSION['err_msg']['address2'] = "恐れ入りますが、町名番地等は50文字以内で入力してください。";
            return false;
        }
        return true;
    }


    /**
     * メールアドレスの妥当性をチェックします。
     *
     * @param string $email メールアドレス
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidEmail($email, &$msg): bool
    {
        $msg = '';
        if (empty($email)) {
            $msg = "メールアドレスを入力してください。";
            return false;
        }
        if (!empty($email) && !preg_match('|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|', $email)) {
            $msg = "メールアドレスを正しく入力してください。";
            return false;
        }
        if (strlen($email) > 256) {
            $msg = "恐れ入りますが、メールアドレスは256文字以内で入力してください。";
            return false;
        }
        return true;
    }


    /**
     * 電話番号の妥当性をチェックします。
     *
     * @param stirng $phoneNumber 電話番号
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidPhoneNumber($phoneNumber, &$msg): bool
    {
        $msg = '';
        if (!empty($phoneNumber) && !preg_match('/^[0-9]{2,4}-?[0-9]{2,4}-?[0-9]{3,4}$/', $phoneNumber)) {
            $msg = "電話番号を正しく入力してください。";
            return false;
        }
        return true;
    }


    /**
     * お問い合わせ内容の妥当性をチェックします。
     *
     * @param  $contact お問い合わせ内容
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidContact($contact, &$msg): bool
    {
        $msg = '';
        if (strlen($contact) > 1000) {
            $_SESSION['err_msg']['contact'] = "恐れ入りますが、お問い合わせ内容は1,000文字以内で入力してください。";
            return false;
        }
        return true;
    }
}
