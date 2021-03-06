<?php

namespace LearnCast\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use LearnCast\Category;
use LearnCast\Favourite;
use LearnCast\Http\Requests\CategoryRequest;
use LearnCast\Video;

class CategoryController extends Controller
{
    /**
     * This method loads all video categories.
     *
     * @param void
     *
     * @return void
     */
    public function index()
    {
        $category = Category::where('user_id', Auth::user()->id)->count();

        $favourite = Favourite::with('video')
        ->getVideoFavouritedByUser(Auth::user()->id)
        ->count();

        $videos = Video::where('user_id', Auth::user()->id)->count();

        return view('dashboard.index', compact('favourite', 'videos', 'category'));
    }

    /**
     * This method creates video category.
     *
     * @param CategoryRequest $request
     *
     * @return view
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'name'        => $request->input('name'),
            'description' => $request->input('description'),
            'user_id'     => Auth::user()->id,
            ]);

        if (!is_null($category)) {
            return redirect('/dashboard/category/add')->with(
                'status',
                'Sucessfully created!'
            );
        }

        return redirect('/dashboard/category/add')->with(
            'status',
            'Oops! Something went wrong!'
            );
    }

    /**
     * This method updates video category.
     *
     * @param CategoryRequest $request
     * @param $id
     *
     * @return view
     */
    public function updateCategory(Request $request, $id)
    {
        $this->validate($request, [
            'name'         => 'required|max:20|unique:categories,name,'.$id,
            'description'  => 'required|max:256',
        ]);

        $category = Category::getCategoryById($id)
        ->update([
            'name'        => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        if (!is_null($category)) {
            return redirect('/dashboard/category/view');
        }

        return redirect('/dashboard/category/edit'.$id)->with(
            'status',
            'Oops! Something went wrong!'
        );
    }

    /**
     * This method gets category by its id.
     *
     * @param $id
     *
     * @return view
     */
    public function getCategory($id)
    {
        $category = Auth::user()->categories()->find($id);

        if (is_null($category)) {
            return redirect('/dashboard/category/add')->with(
                'status',
                'Oops! unauthorized access to video category!'
            );
        }

        return view('dashboard.pages.view_video_category', compact('category'));
    }

    /**
     * This method fetches all video categories.
     *
     * @param void
     *
     * @return view
     */
    public function viewAllCategories()
    {
        $userId = Auth::user()->id;

        $categories = Category::getCategoriesByUserId($userId)
        ->orderBy('id', 'asc')
        ->paginate(10);

        $pendingCategories = Category::allTrashedCategories($userId)
        ->paginate(10);

        return view('dashboard.pages.list_video_categories', compact(
            'categories',
            'pendingCategories'
        ));
    }

    /**
     * This method changes the status of video category.
     *
     * @param $request
     * @param $id
     *
     * @return response
     */
    public function changeCategoryStatus(Request $request, $id)
    {
        $category = null;

        if ($request->input('status') == 0) {
            $category = Category::setCategoryStatus($id)->delete();
        } else {
            $category = Category::setCategoryStatus($id)->restore();
        }

        if (!is_null($category)) {
            return [
                'statuscode' => 200,
                'message'    => 'Operation Successfully',
            ];
        }

        return [
            'statuscode' => 404,
            'message'    => 'Invalid Category ID!',
        ];
    }
}
