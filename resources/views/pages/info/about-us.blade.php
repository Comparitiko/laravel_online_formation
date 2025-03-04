<x-layouts.guest title="Sobre nosotros">
    <main class="bg-slate-800 min-h-screen p-4 text-white">
        <h1 class="mb-4 text-sm text-center text-xl">
            Sobre nosotros
        </h1>

        <article class="mx-auto w-1/2">
            <p class="mb-6">
                En <span class="text-xl text-bold text-red-700">{{config('app.name')}}</span>, creemos que la educación debe
                ser
                accesible,
                flexible y de
                calidad. Por eso, hemos creado un espacio de aprendizaje online diseñado para ayudarte a desarrollar nuevas habilidades, mejorar tu carrera y alcanzar tus metas personales y profesionales.
            </p>
            <p class="mb-6">
                Nuestro equipo está formado por expertos en diversas áreas que comparten una pasión por la enseñanza y la innovación. A través de cursos interactivos, materiales actualizados y un enfoque práctico, te ofrecemos una experiencia de aprendizaje adaptada a tus necesidades.
            </p>
            <p class="mb-6">
                Ya sea que busques mejorar tus conocimientos, cambiar de profesión o simplemente aprender algo nuevo, en [Nombre de la Plataforma] encontrarás los recursos y el apoyo que necesitas para avanzar.
            </p>

            <p class="mb-6">
                Únete a nuestra comunidad de estudiantes y da el siguiente paso en tu formación. ¡El conocimiento está a un clic de distancia!
            </p>
            <x-buttons.primary-button onclick="history.back()">
                Volver
            </x-buttons.primary-button>
        </article>

    </main>
</x-layouts.guest>
