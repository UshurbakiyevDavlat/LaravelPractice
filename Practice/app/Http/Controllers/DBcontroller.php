<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
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
                "datweas" . $lastId
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

    public function getAllEmployees()
    {
        $employees = DB::table('employees')
            ->select('name', 'position', 'salary')
            ->where('salary', '>=', '450')
            ->where('salary', '!=', '500')
            ->orWhere('id', '>', 4)
            ->get();
        $employeeBest = DB::table('employees')
            ->select('name', 'position', 'salary')
            ->where('id', '=', 3)
            ->first();

        $employeeWorst = DB::table('employees')
            ->select('name', 'position', 'salary')
            ->where('id', '=', 5)
            ->first();

        $employeesNames = DB::table('employees')
            ->pluck('name');

        $expensive = DB::table('employees')
            ->select('name', 'salary')
            ->whereBetween('salary', [450, 1100])
            ->get();

        $expensiveOrUnexpensive = DB::table('employees')
            ->select('name', 'salary')
            ->whereNotBetween('salary', [300, 600])
            ->get();
        $randEmployees = DB::table('employees')
            ->select('name', 'salary')
            ->whereIn('id', [1, 2, 3, 5])
            ->get();
        $randEmployees2 = DB::table('employees')
            ->select('name', 'salary')
            ->whereNotIn('id', [1, 2, 3])
            ->get();

        $groupCondition = DB::table('employees')
            ->select('name', 'salary')
            ->where(function ($query) {
                $query->whereBetween('id', [1, 3]);
                $query->OrWhere(function ($query2) {
                    $query2->where('salary', '>', 400);
                    $query2->where('salary', '<', 800);
                });
            })
            ->get();

        $dynamic = DB::table('employees')
            ->select('name', 'salary', 'position')
            ->whereSalaryOrPosition(500, 'программист')
            ->get();

        $dynamic2 = DB::table('employees')
            ->select('name', 'salary', 'position')
            ->whereSalaryAndPosition(500, 'программист')
            ->get();

        $bycolum = DB::table('events')
            ->select('*')
            ->whereColumn('start', 'finish')
            ->get();

        $bySalary = DB::table('employees')
            ->select('name', 'salary', 'position')
            ->orderBy('salary')
            ->get();

        $bySalaryDesc = DB::table('employees')
            ->select('name', 'salary', 'position')
            ->orderByDesc('salary')
            ->get();

        $maxSalary = DB::table('employees')
            ->select('name', 'salary', 'position')
            ->havingRaw('MAX(salary) = 1000')
            ->groupBy('name', 'position', 'salary')
            ->get();

        $sumSalary = DB::table('employees')
            ->select(DB::raw('SUM(salary) as total'))
            ->groupBy('salary')
            ->get();

        $totalSum = 0;
        foreach ($sumSalary as $sum) {
            $totalSum += $sum->total;
        }

        $maxAndMinSalaryGroup = DB::table('employees')
            ->select(DB::raw('MAX(salary) as MAX'), DB::raw('MIN(salary) as MIN'), DB::raw('SUM(salary) as total'))
            ->groupBy('position')
            ->get();

        $whereBirth1 = DB::table('employees')
            ->select('name', 'birthday')
            ->wheredate('birthday', '=', '1988-03-25')
            ->get();

        $whereBirth2 = DB::table('employees')
            ->select('name', 'birthday')
            ->whereDay('birthday', '=', 25)
            ->get();

        $whereBirth3 = DB::table('employees')
            ->select('name', 'birthday')
            ->whereMonth('birthday', '=', 3)
            ->get();

        $whereBirth4 = DB::table('employees')
            ->select('name', 'birthday')
            ->whereYear('birthday', '=', 1990)
            ->get();

        print_r($whereBirth1);
        print_r($whereBirth2);
        print_r($whereBirth3);
        print_r($whereBirth4);

        if (!$employees) return response(['error' => 'employee array is empty', 302]);
        if (!$employeeBest) return response(['error' => 'best employee is empty', 302]);
        if (!$employeeWorst) return response(['error' => 'worst employee is empty', 302]);

        return view('components.employees.all', ['employees' => $employees]);
    }

    public function buildInsertUsers()
    {
        $counter = Cache::get('ctr');
        if (!$counter) Cache::remember('ctr', 360, function () {
            return random_int(150, 3500);
        });
        $cacheId = Cache::get('id');
        if (!$cacheId) {
            $cacheId = Cache::remember('id', '360', function () use ($counter) {
                return $counter + random_int(100, 300);
            });
        }
        echo $cacheId;
        $ins = DB::table('users')->insert([
                [
                    'name' => 'test1',
                    'email' => 'dushur1' . $cacheId . '@gmail.com',
                    'age' => 22,
                    'password' => 'pass',
                    'remember_token' => 'token'
                ],
                [
                    'name' => 'test2',
                    'email' => 'dushur2' . $cacheId . '@gmail.com',
                    'age' => 22,
                    'password' => 'pass',
                    'remember_token' => 'token'
                ],
                [
                    'name' => 'test3',
                    'email' => 'dushur3' . $cacheId . '@gmail.com',
                    'age' => 22,
                    'password' => 'pass',
                    'remember_token' => 'token'
                ]
            ]
        );
        return $ins;
    }

    public function buildOperationsUsers()
    {
        if (!self::buildInsertUsers()) return response(['error' => 'insertion failed']);
        try {
            $update = DB::table('users')
                ->updateOrInsert(
                    [
                        'id' => 52,
                    ],
                    [
                        'name' => 'updatedHyatt',
                        'email' => 'updated@gmail.com',
                        'age' => 21,
                        'password' => 'pass'
                    ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
        try {
            $delete = DB::table('users')->delete('131');
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
        return print_r($delete);
    }

    public function crossingRelate()
    {
        return dd(Db::table('products')
            ->select('products.name', 'categories.name', 'categories.rarity')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->get());
    }

    public function eloqStart($order = "date", $dir = 1)
    {
        $all = Post::all();
        if ($dir) {
            $posts = $all->sortByDesc(function ($post) use ($order) {
                return $post->$order;
            });
        } else {
            $posts = $all->sortBy(function ($post) use ($order) {
                return $post->$order;
            });
        }

        return view('components.posts.all', [
            'posts' => $posts
        ]);
    }

    public function getOnePost($id)
    {
        return view('components.posts.one', ['post' => Post::find($id)->firstOrFail()]);
    }

}
