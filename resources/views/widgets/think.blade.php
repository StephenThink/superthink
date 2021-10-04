<style>
    .think {
        
    }
</style>
<div class="widget_thinkcreative card p-0 content">
    <div class="py-2 px-4 border-b header" style="background-color: #808080 !important; color: #fc0 !important;">
        <div class="w-full lg:w-1/2 pr-5 flex items-start">
            <img src="/assets/svgs/think.svg" class="tc_logo" alt="Think!Creative Logo">
        </div>
    </div>
    <div class="py-3 px-4 border-b">
        <p>Welcome to the dashboard for the {{ env( 'APP_NAME' ) }} website. Below are some quick links to the most commonly updated areas of the website.</p>
    </div>
    <div class="flex flex-wrap p-2">
        <a href="{{ cp_route('collections.index') }}" class="w-full lg:w-1/2 p-2 flex items-start hover:bg-grey-20 rounded-md group">
            <div class="h-8 w-8 mr-2 text-grey-80">
                @svg('collections')
            </div>
            <div class="flex-1">
                <h3 class="mb-1 text-blue">View Collections</h3>
                <p>Access and edit all pages on the website, including adding and editing Capabilities</p>
            </div>
        </a>
        <a href="{{ cp_route('assets.index') }}" class="w-full lg:w-1/2 p-2 flex items-start hover:bg-grey-20 rounded-md group">
            <div class="h-8 w-8 mr-2 text-grey-80">
                @svg('assets')
            </div>
            <div class="flex-1">
                <h3 class="mb-1 text-blue">View Assets</h3>
                <p>Add, edit, rename and delete images from the website</p>
            </div>
        </a>
    </div>
</div>