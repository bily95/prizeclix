<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LanguageController extends Controller
{

    public function langManage($lang = false)
    {
        $pageTitle = 'Language Manager';
        $emptyMessage = 'No language has been added.';
        $languages = Language::orderBy('is_default', 'desc')->get();
        return view('admin.setting.language.lang', compact('pageTitle', 'emptyMessage', 'languages'));
    }

    public function langStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'file' => 'required|mimes:json',
            'code' => 'required|unique:languages'
        ]);


        $json_file = strtolower($request->code) . '.json';
        $path = resource_path('lang');

        $request->file->move($path, $json_file);

        $language = new  Language();
        if ($request->is_default) {
            $lang = $language->where('is_default', 1)->first();
            if ($lang) {
                $lang->is_default = 0;
                $lang->save();
            }
        }
        $language->name = $request->name;
        $language->code = strtolower($request->code);
        $language->is_default = $request->is_default ? 1 : 0;
        $language->save();

        $notify[] = ['success', 'Create successfully'];
        return back()->withNotify($notify);
    }

    public function langUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $language = Language::findOrFail($id);

        if ($request->is_default) {
            $lang = $language->where('is_default', 1)->first();
            if ($lang) {
                $lang->is_default = 0;
                $lang->save();
            }
        }


        $language->name = $request->name;
        $language->is_default = $request->is_default ? 1 : 0;
        $language->save();

        $notify[] = ['success', 'Update successfully'];
        return back()->withNotify($notify);
    }

    public function langDel($id)
    {
        $lang = Language::find($id);
        removeFile(resource_path('lang/') . $lang->code . '.json');
        $lang->delete();
        $notify[] = ['success', 'Language deleted successfully'];
        return back()->withNotify($notify);
    }

    public function langEdit($id)
    {
        $lang = Language::find($id);
        $pageTitle = "Update " . $lang->name . " Keywords";
        $json = file_get_contents(resource_path('lang/') . $lang->code . '.json');
        $list_lang = Language::all();


        if (empty($json)) {
            $notify[] = ['error', 'File not found'];
            return back()->withNotify($notify);
        }
        $json = json_decode($json);

        return view('admin.setting.language.edit_lang', compact('pageTitle', 'json', 'lang', 'list_lang'));
    }


    public function storeLanguageJson(Request $request, $id)
    {
        $lang = Language::find($id);
        $this->validate($request, [
            'key' => 'required',
            'value' => 'required'
        ]);

        $items = file_get_contents(resource_path('lang/') . $lang->code . '.json');

        $reqKey = trim($request->key);

        if (array_key_exists($reqKey, json_decode($items, true))) {
            $notify[] = ['error', "`$reqKey` Already exist"];
            return back()->withNotify($notify);
        } else {
            $newArr[$reqKey] = trim($request->value);
            $itemsss = json_decode($items, true);
            $result = array_merge($itemsss, $newArr);
            file_put_contents(resource_path('lang/') . $lang->code . '.json', json_encode($result));
            $notify[] = ['success', "`" . trim($request->key) . "` has been added"];
            return back()->withNotify($notify);
        }
    }
    public function deleteLanguageJson(Request $request, $id)
    {
        $this->validate($request, [
            'key' => 'required',
            'value' => 'required'
        ]);

        $reqkey = $request->key;
        $lang = Language::find($id);
        $data = file_get_contents(resource_path('lang/') . $lang->code . '.json');

        $json_arr = json_decode($data, true);
        unset($json_arr[$reqkey]);

        file_put_contents(resource_path('lang/') . $lang->code . '.json', json_encode($json_arr));
        $notify[] = ['success', "`" . trim($request->key) . "` has been removed"];
        return back()->withNotify($notify);
    }
    public function updateLanguageJson(Request $request, $id)
    {
        $this->validate($request, [
            'key' => 'required',
            'value' => 'required'
        ]);

        $reqkey = trim($request->key);
        $reqValue = $request->value;
        $lang = Language::find($id);

        $data = file_get_contents(resource_path('lang/') . $lang->code . '.json');

        $json_arr = json_decode($data, true);

        $json_arr[$reqkey] = $reqValue;

        file_put_contents(resource_path('lang/') . $lang->code . '.json', json_encode($json_arr));

        $notify[] = ['success', 'Updated successfully'];
        return back()->withNotify($notify);
    }
}
