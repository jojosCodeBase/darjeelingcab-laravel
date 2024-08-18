<?php

namespace App\Http\Controllers;

use SEOMeta;
use Twitter;
use OpenGraph;
use JsonLd;
use Carbon\Carbon;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MonthlyVisits;
use App\Http\Controllers\Controller;


class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderByDesc('created_at')->paginate(10); // Fetch blogs with pagination
        return view('admin.blogs.blogs', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create-blog');
    }

    public function show()
    {
        $blogs = Blog::where('status', 1)->orderByDesc('created_at')->get();
        return view('blogs', compact('blogs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:blogs,title',
            'content' => 'required',
            'author' => 'required',
            'thumbnail' => 'required|image|max:500',
            // 'image' => 'nullable|image|max:500',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string',
            'og_image' => 'nullable|image|max:500',
            'twitter_image' => 'nullable|image|max:500',
        ]);

        $data = $request->all();

        $data['slugged_title'] = Str::slug($request->title);

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $imageName = 'thumbnail_' . time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('assets/blogs'), $imageName);
            $data['thumbnail'] = 'assets/blogs/' . $imageName;
            $data['og_image'] = $data['thumbnail'];
            $data['twitter_image'] = $data['thumbnail'];
        }

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = 'image_' . time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('assets/blogs'), $imageName);
        //     $data['image'] = 'assets/blogs/' . $imageName;
        // }

        if ($request->hasFile('og_image')) {
            $ogImage = $request->file('og_image');
            $ogImageName = 'og_' . time() . '.' . $ogImage->getClientOriginalExtension();
            $ogImage->move(public_path('assets/blogs'), $ogImageName);
            $data['og_image'] = 'assets/blogs/' . $ogImageName;
        }

        if ($request->hasFile('twitter_image')) {
            $twitterImage = $request->file('twitter_image');
            $twitterImageName = 'twitter_' . time() . '.' . $twitterImage->getClientOriginalExtension();
            $twitterImage->move(public_path('assets/blogs'), $twitterImageName);
            $data['twitter_image'] = 'assets/blogs/' . $twitterImageName;
        }

        Blog::create($data);
        return redirect()->route('blogs')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit-blog', compact('blog'));
    }

    public function checkAndDeleteUnusedImages($originalImages, $updatedImages)
    {
        foreach ($originalImages as $path) {
            if ($path && file_exists(public_path($path)) && !in_array($path, $updatedImages)) {
                unlink(public_path($path));
            }
        }
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'author' => 'required',
            'thumbnail' => 'nullable|image|max:500',
            // 'image' => 'nullable|image|max:500',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string',
            'og_image' => 'nullable|image|max:500',
            'twitter_image' => 'nullable|image|max:500',
        ]);

        // Store original image paths
        $originalImages = [
            'thumbnail' => $blog->thumbnail,
            'og_image' => $blog->og_image,
            'twitter_image' => $blog->twitter_image,
            'image' => $blog->image
        ];

        // Initialize updated images array with original paths
        $updatedImages = $originalImages;

        $data = $request->all();

        $data['slugged_title'] = Str::slug($request->title);

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $imageName = 'thumbnail_' . time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('assets/blogs'), $imageName);
            $data['thumbnail'] = 'assets/blogs/' . $imageName;
            $updatedImages['thumbnail'] = 'assets/blogs/' . $imageName;
        }

        if ($request->hasFile('og_image')) {
            $ogImage = $request->file('og_image');
            $ogImageName = 'og_' . time() . '.' . $ogImage->getClientOriginalExtension();
            $ogImage->move(public_path('assets/blogs'), $ogImageName);
            $data['og_image'] = 'assets/blogs/' . $ogImageName;
            $updatedImages['og_image'] = 'assets/blogs/' . $ogImageName;
        }

        if ($request->hasFile('twitter_image')) {
            $twitterImage = $request->file('twitter_image');
            $twitterImageName = 'twitter_' . time() . '.' . $twitterImage->getClientOriginalExtension();
            $twitterImage->move(public_path('assets/blogs'), $twitterImageName);
            $data['twitter_image'] = 'assets/blogs/' . $twitterImageName;
            $updatedImages['twitter_image'] = 'assets/blogs/' . $twitterImageName;
        }

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = 'image_' . time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('assets/blogs'), $imageName);
        //     $data['image'] = 'assets/blogs/' . $imageName;
        // }

        $blog->update($data);

        // Check and delete unused images
        $this->checkAndDeleteUnusedImages($originalImages, $updatedImages);

        return redirect()->route('blogs')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $images = ['thumbnail', 'og_image', 'twitter_image'];

        foreach ($images as $image) {
            if ($blog->getAttribute($image) && file_exists(public_path($blog->getAttribute($image)))) {
                unlink(public_path($blog->getAttribute($image)));
            }
        }

        $blog->delete();
        return redirect()->route('blogs')->with('success', 'Blog deleted successfully.');
    }

    public function updateStatus(Request $request)
    {
        $blog = Blog::findOrFail($request->blog_id);

        $blog->status = $blog->status == 1 ? 2 : 1;
        $blog->save();

        if ($blog) {
            if ($blog->status == 1)
                return response(['success' => 'published']);
            else
                return response(['success' => 'draft']);
        } else
            return response(['error' => 'Some error occured']);
    }

    public function viewBlog($slug)
    {
        $blog = Blog::where('slugged_title', $slug)->firstOrFail();

        // Check if the user has already viewed this blog in the current session
        if (!session()->has('blog_' . $blog->id . '_viewed')) {
            $blog->increment('views');
            session(['blog_' . $blog->id . '_viewed' => true]);
        }

        // Get the previous two blogs
        $previousBlogs = Blog::where('id', '<', $blog->id)
            ->orderBy('id', 'desc')
            ->take(1)
            ->get();

        // Get the next two blogs
        $nextBlogs = Blog::where('id', '>', $blog->id)
            ->orderBy('id', 'asc')
            ->take(1)
            ->get();

        $recentBlogs = $previousBlogs->merge($nextBlogs);

        // log monthly visits

        // Get the current month start and end dates
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        $monthlyVisit = MonthlyVisits::where('blog_id', $blog->id)
            ->whereBetween('start_date', [$currentMonthStart, $currentMonthEnd])
            ->whereBetween('end_date', [$currentMonthStart, $currentMonthEnd])
            ->first();

        if ($monthlyVisit) {
            // Increment visits if record exists for the current month
            $monthlyVisit->increment('visits');
        } else {
            // Create a new MonthlyVisit record for the current month
            MonthlyVisits::create([
                'blog_id' => $blog->id,
                'start_date' => $currentMonthStart,
                'end_date' => $currentMonthEnd,
                'visits' => 1, // Initial visit count
            ]);
        }

        // SEO data
        $title = $blog->title;
        $description = $blog->meta_description;
        $keywords = $blog->meta_keywords;

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::addKeyword($keywords);
        SEOMeta::setCanonical('https://www.darjeelingcab.in/');

        OpenGraph::setDescription($description);
        OpenGraph::setTitle($title);
        OpenGraph::setUrl('https://www.darjeelingcab.in/');
        OpenGraph::addProperty('type', 'Darjeeling Cab');
        OpenGraph::addImage(asset($blog->og_image));

        Twitter::setTitle($title);
        Twitter::setSite('@Darjeeling_Cab');
        Twitter::setDescription($description);
        Twitter::setUrl('https://www.darjeelingcab.in/');
        Twitter::setImage(asset($blog->twitter_image));

        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setType('WebPage');
        JsonLd::addImage(asset($blog->thumbnail));

        return view('blog-info', compact('blog', 'recentBlogs'));
    }
}
