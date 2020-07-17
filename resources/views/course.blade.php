@extends('layouts.course')

@section('main')
<div class="col-md-3">
  <div class="row">
		
	</div>


</div>
  <div class="col-md-9">

      <div class="row">

        <h2>{{ $course->title }}</h2>

        @if ($purchased_course)
            Rating: {{ $course->rating }} / 5
            <br />
            <b>Rate the course:</b>
            <br />
            <form action="{{ route('courses.rating', [$course->id]) }}" method="post">
                {{ csrf_field() }}
                <select name="rating">
                    <option value="1">1 - Awful</option>
                    <option value="2">2 - Not too good</option>
                    <option value="3">3 - Average</option>
                    <option value="4" selected>4 - Quite good</option>
                    <option value="5">5 - Awesome!</option>
                </select>
                <input type="submit" value="Rate" />
            </form>
            <hr />
        @endif

        <p>{{ $course->description }}</p>

        <p>
            @if (\Auth::check())
                @if ($course->students()->where('user_id', \Auth::id())->count() == 0 && $course->price != 0)
                <div class="btn btn-success">Худалдаж авах</div>
                @endif
            @else
                <a href="{{ route('auth.register') }}?redirect_url={{ route('courses.show', [$course->slug]) }}"
                   class="btn btn-primary">Та нэвтрээгүй байна</a>
            @endif
        </p>


        @foreach ($course->publishedLessons as $lesson)
            @if ($lesson->free_lesson)@endif {{ $loop->iteration }}.
            <a href="{{ route('lessons.show', [$lesson->course_id, $lesson->slug]) }}">{{ $lesson->title }}</a>
            <p>{{ $lesson->short_text }}</p>
            <hr />
        @endforeach

      </div>

  </div>


@endsection
