@props(['course'])

<article class="max-w-sm flex flex-col justify-between rounded-xl overflow-hidden shadow-lg bg-gray-900 text-white
transition-transform
duration-300
hover:scale-105">
    <!-- Course Content -->
    <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">{{ $course->name }}</div>
        <p class="text-gray-400 text-sm mb-4">
            {{ $course->description }}
        </p>
    </div>

    <section class="px-6 py-4">
        <!-- Course Meta -->
        <section class="flex items-center mb-4">
            <div class="w-10 h-10 rounded-full bg-indigo-700 flex items-center justify-center mr-4">
                <span class="text-white font-bold">{{ $course->teacher->initials() }}</span>
            </div>
            <div>
                <p class="text-white text-sm font-semibold">
                    {{ $course->teacher->name }} {{ $course->teacher->surnames }}
                </p>
            </div>
        </section>

        <!-- Course Stats -->
        <section class="flex justify-between text-gray-400 text-xs mb-4">
                <span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $course->duration }} horas
                </span>
        </section>
    </section>

    <section>
        <!-- Price and Action -->
        <div class="px-6 py-4 bg-gray-800 flex justify-between items-center">
            @if(request()->routeIs('students.courses.registered'))
                <x-cards.components.materials-button :course="$course" />
            @else
                <x-cards.components.registration-button :course="$course" />
            @endif
        </div>

        <!-- Tags -->
        <div class="px-6 pt-2 pb-4 bg-gray-800">
            <span class="inline-block bg-gray-700 rounded-full px-3 py-1 text-xs font-semibold text-gray-300 mr-2
            mb-2 capitalize">
                {{ $course->category->course_area_name }}
            </span>
        </div>
    </section>
</article>
