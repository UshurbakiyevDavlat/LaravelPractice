<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DBcontroller extends Controller
{
    public function raw()
    {
        $lastId = DB::select('SELECT id FROM users ORDER BY id DESC LIMIT 1');
        $lastId = $lastId[0]->id + 1;
        $users = DB::select('SELECT * FROM users WHERE age > ?', [18]);
        $new = DB::insert('INSERT INTO users (id,name,email,password,age,email_verified_at,created_at,updated_at,remember_token) values (?,?,?,?,?,?,?,?,?)',
            [
                $lastId,
                'Davlat',
                'dushurbakiev@gmail.com' . $lastId,
                'HGs4123-4ww123r-sdssa', 22,
                date('Y-m-d H:i:s'),
                date('Y-m-d H:i:s'),
                date('Y-m-d H:i:s'),
                "datweas".$lastId
            ]);

        $update = DB::update('UPDATE users set name = ? WHERE id = ?', ['DavlatTest', $lastId]);
        $delete = DB::delete('DELETE FROM users WHERE id = ?', [$lastId - 1]);

        if (!$users) return print('error while select');
        if (count($users) < 0) {
            echo "Users list is empty";
            return response("empty list", ResponseAlias::HTTP_FOUND);
        }

        if (!$new) return print('error while insert');
        if (!$update) return print('error while update');
        if (!$delete) return print('error while delete');

        return view('components.user.raw', ['users' => $users]);
    }
}
