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
        <a href="{{ cp_route('collections.show', ['pages']) }}" class="w-full lg:w-1/2 p-2 flex items-start hover:bg-grey-20 rounded-md group">
            <div class="h-8 w-8 mr-2 text-grey-80">
                 @cp_svg('collections') 
            </div>
            <div class="flex-1">
                <h3 class="mb-1 text-blue">View Pages</h3>
                <p>See all the main pages that make the backbone of the site.</p>
            </div>
        </a>
        <a href="{{ cp_route('collections.show', ['blog']) }}" class="w-full lg:w-1/2 p-2 flex items-start hover:bg-grey-20 rounded-md group">
            <div class="h-8 w-8 mr-2 text-grey-80">
                 @cp_svg('content-writing') 
            </div>
            <div class="flex-1">
                <h3 class="mb-1 text-blue">View Blog Posts</h3>
                <p>View all the Blog Posts.</p>
            </div>
        </a>
        <a href="{{ cp_route('collections.show', ['case_studies']) }}" class="w-full lg:w-1/2 p-2 flex items-start hover:bg-grey-20 rounded-md group">
            <div class="h-8 w-8 mr-2 text-grey-80">
                @cp_svg('content-writing')
            </div>
            <div class="flex-1">
                <h3 class="mb-1 text-blue">View Case Studies</h3>
                <p>People we have worked with.</p>
            </div>
        </a>
        <a href="{{ cp_route('collections.show', ['employees']) }}" class="w-full lg:w-1/2 p-2 flex items-start hover:bg-grey-20 rounded-md group">
            <div class="h-8 w-8 mr-2 text-grey-80">
                 @cp_svg('users-box') 
            </div>
            <div class="flex-1">
                <h3 class="mb-1 text-blue">View Employees</h3>
                <p>Make additions or changes to the current members of the Think Team.</p>
            </div>
        </a>
        <a href="{{ cp_route('taxonomies.show', ['core']) }}" class="w-full lg:w-1/2 p-2 flex items-start hover:bg-grey-20 rounded-md group">
            <div class="h-8 w-8 mr-2 text-grey-80">
                @cp_svg('collections')
            </div>
            <div class="flex-1">
                <h3 class="mb-1 text-blue">Core Services</h3>
                <p>This links to a collection called services, looks like it is a category style / filter.</p>
            </div>
        </a>
        <a href="{{ cp_route('taxonomies.show', ['services_filter']) }}" class="w-full lg:w-1/2 p-2 flex items-start hover:bg-grey-20 rounded-md group">
            <div class="h-8 w-8 mr-2 text-grey-80">
                 @cp_svg('collections') 
            </div>
            <div class="flex-1">
                <h3 class="mb-1 text-blue">Services Filter</h3>
                <p>This links to a collection called Case Studies.</p>
            </div>
        </a>
        <a href="/cp/globals/special_nav" class="w-full lg:w-1/2 p-2 flex items-start hover:bg-grey-20 rounded-md group">
            <div class="h-8 w-8 mr-2 text-grey-80">
                 @cp_svg('toggle') 
            </div>
            <div class="flex-1">
                <h3 class="mb-1 text-blue">Tea Roulette / Secret Santa</h3>
                <p>Choose which to show on the Main Nav of the site.</p>
            </div>
        </a>
    </div>
</div>