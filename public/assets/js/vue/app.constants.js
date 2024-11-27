function getMessage($str){
    $message = {
        'redirect': 'You will be redirected, please wait...',
        'success.login': "Login successful. Welcome back!",
        'success.update': "The data has updated successfully!",
        'success.profile_school_update': "Your school information has updated successfully!",
        'success.create_password': "Password created successfully. You can now login with your new password.",
        'success.update_password': "Password updated successfully. You can now login with your new password.",
        'success.delete': "The data has deleted successfully!",
        'success.create': "The data has created successfully!",

        'error.generic': 'An error occurred. Please try again later.',
        'error.server_timeout': 'Server timeout. Please try again later.',
        'error.email_required': 'Email is required.',
        'error.password_required': 'Password is required.',

        'confirm.delete': 'Are you sure you want to delete this item?',
    }
    return ($message[$str]) ? $message[$str] : '';
}