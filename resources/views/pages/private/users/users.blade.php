<x-layouts.private title="Usuarios">
    <main class="max-w-6xl mx-auto">
        <div class="relative overflow-auto shadow-xl rounded-xl border-gray-900">
            <x-tables.table>
                <x-tables.thead>
                    <x-tables.thead-th>DNI</x-tables.thead-th>
                    <x-tables.thead-th>Nombre de usuario</x-tables.thead-th>
                    <x-tables.thead-th>Nombre</x-tables.thead-th>
                    <x-tables.thead-th>Email</x-tables.thead-th>
                    <x-tables.thead-th>Número de telefono</x-tables.thead-th>
                    <x-tables.thead-th>Rol</x-tables.thead-th>
                    <x-tables.thead-th>Acciones</x-tables.thead-th>
                </x-tables.thead>
                <tbody>
                @foreach($users as $user)
                    <x-tables.tbody-tr>
                        <x-tables.tbody-th>{{ $user->dni }}</x-tables.tbody-th>
                        <x-tables.tbody-td>{{ $user->username }}</x-tables.tbody-td>
                        <x-tables.tbody-td>{{ $user->name }} {{ $user->surnames }}</x-tables.tbody-td>
                        <x-tables.tbody-td>{{ $user->email }}</x-tables.tbody-td>
                        <x-tables.tbody-td>
                            {{ $user->phone_number }}
                        </x-tables.tbody-td>
                        <x-tables.tbody-role-td
                            optional_classes="capitalize"
                        >
                            {{ $user->role->value }}
                        </x-tables.tbody-role-td>
                        <x-tables.tbody-td optional_classes="flex items-center gap-4">
                            <x-buttons.delete-user-button
                                :hasActiveRegistrations="$user->hasActiveRegistrations()"
                                :user="$user"
                            />
                            <x-buttons.student-button :user="$user" />
                            <x-buttons.teacher-button :user="$user" />
                            <x-buttons.admin-button :user="$user" />
                        </x-tables.tbody-td>
                    </x-tables.tbody-tr>
                @endforeach
                </tbody>
            </x-tables.table>
        </div>
        <x-default-paginator :model="$users" />
    </main>
</x-layouts.private>
