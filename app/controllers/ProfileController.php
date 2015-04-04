<?php

class ProfileController extends \BaseController {


    public function showProfile()
    {
        if (Session::has('expiretime')) {
            if (Session::get('expiretime') < time()) {
                Auth::logout();
                Session::flush();
                return View::make('login')->with('errorMessage', 'Your session has expired. Please login again.');
            } else {
                Session::put('expiretime', time() + 1200);
                $user = Session::get('user');
                return View::make('profile')->with('user', $user);
            }
        }
        else
            return View::make('register');
    }

    public function saveData()
    {
        if (Session::has('expiretime')) {
            if (Session::get('expiretime') < time()) {
                Auth::logout();
                Session::flush();
                return View::make('login')->with('errorMessage', 'Your session has expired. Please login again.');
            }
            else {
                Session::put('expiretime', time() + 1200);

                $user = Session::get('user');
                $user->notes = Input::get('notes');
                $user->tbd = Input::get('tbd');
                $user->hyperlink1 = Input::get('hyperlink1');
                $user->hyperlink2 = Input::get('hyperlink2');
                $user->hyperlink3 = Input::get('hyperlink3');
                $user->hyperlink4 = Input::get('hyperlink4');
                $user->hyperlink5 = Input::get('hyperlink5');
                $user->hyperlink6 = Input::get('hyperlink6');
                $user->hyperlink7 = Input::get('hyperlink7');
                $user->hyperlink8 = Input::get('hyperlink8');

                $deleteImage1 = Input::get('deleteImage1');
                if ($deleteImage1 == true)
                    $user->image1 = null;
                if (Validator::make(['image' => Input::file('image1')], ['image' => 'mimes:gif,jpg,jpeg'])->passes()) {
                    $imageFile1 = Input::file('image1');
                    if ($imageFile1 != null)
                        $user->image1 = base64_encode(file_get_contents($imageFile1->getRealPath()));
                }

                $deleteImage2 = Input::get('deleteImage2');
                if ($deleteImage2 == true)
                    $user->image2 = null;
                if (Validator::make(['image' => Input::file('image2')], ['image' => 'image|mimes:jpg,jpeg,gif'])->passes()) {
                    $imageFile2 = Input::file('image2');
                    if($imageFile2 != null)
                        $user->image2 = base64_encode(file_get_contents($imageFile2->getRealPath()));
                }

                $deleteImage3 = Input::get('deleteImage3');
                if ($deleteImage3 == true)
                    $user->image3 = null;
                if (Validator::make(['image' => Input::file('image3')], ['image' => 'image|mimes:jpg,jpeg,gif'])->passes()) {
                    $imageFile3 = Input::file('image3');
                    if ($imageFile3 != null)
                        $user->image3 = base64_encode(file_get_contents($imageFile3->getRealPath()));
                }

                $deleteImage4 = Input::get('deleteImage4');
                if ($deleteImage4 == true)
                    $user->image4 = null;
                if (Validator::make(['image' => Input::file('image4')], ['image' => 'image|mimes:jpg,jpeg,gif'])->passes()) {
                    $imageFile4 = Input::file('image4');
                    if ($imageFile4 != null)
                        $user->image4 = base64_encode(file_get_contents($imageFile4->getRealPath()));
                }

                $user->save();
                return Redirect::to('profile');
            }
        }
        else
            return View::make('register');
    }

    function inValidImage() {
        $validator = Validator::make(Input::get('image1'), ['image1' => 'mimes:jpeg,gif']);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }
}
