<template>
	<ul class="list-none">
	  	<li class="py-2 px-2">
	  		<div class="w-28">
                <inertia-link :href="route('admin.users.index', $page.props.objFnd.alias)" :active="route().current('admin.users.*')" class="text-sm text-gray-700">
                    Users
                </inertia-link>
            </div>
	  	</li>
	  	
	</ul>
</template>
