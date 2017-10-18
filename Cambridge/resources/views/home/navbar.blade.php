@if (Auth::check())
    @if(Auth::user()->level=='User')
        <?php $level=1 ?>
    @elseif ((Auth::user()->level)=='Admin')
        <?php $level=2 ?>
    @else
        <?php $level=3 ?>
    @endif

@else
    You are not signed in.
@endif

<script type="text/javascript">var level="<?= $level?>";</script>

<ul class="nav sidebar-nav">
    <li class="sidebar-brand">
        <a href="#">
            Cambridge
        </a>
    </li>
    <li>
        <a href="{{route('home')}}">Home</a>
    </li>

    <li>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">School Charges<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li class="hidden"><a href="#"></a></li>
            <li><a href="{{route('ViewCharges')}}">View All</a></li>
            <li class="lvl"><a href="{{route('UpdateCharges')}}">Update All charges</a></li>
        </ul>
    </li>
    <li>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Student Management<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li class="hidden"><a href="#"></a></li>
            <li><a href="{{route('studentRegistration')}}">Student Registration</a></li>
            <li><a href="{{route('studentRegistrationUpdate')}}">Student Update</a></li>
            <li><a href="{{route('getStudents')}}">Student Details</a></li>
            <li><a href="{{route('viewUpgrade')}}">Students Upgrade</a></li>
        </ul>
    </li>
    <li>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Revenue<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li class="hidden"><a href="#"></a></li>
            <li><a href="{{route('payFees')}}">Pay Fees</a></li>
            <li><a href="{{route('admission&Ref')}}">Admission & Refundable</a></li>
            <li><a href="{{route('viewStationary')}}">Stationary</a></li>
            <li><a href="{{route('viewOtherIncome')}}">Other Incomes</a></li>
        </ul>
    </li>
    <li>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Expenses<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li class="hidden"><a href="#"></a></li>
            <li><a href="{{route('viewPayExpenses')}}">Pay Expenses</a></li>
            <li><a href="{{route('viewExpenses')}}">View Expenses</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Course Billing<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li class="hidden"><a href="#"></a></li>
            <li><a href="{{route('cosStuReg')}}">Course Students Registration</a></li>
            <li><a href="{{route('UpdateCosStuReg')}}">Update Course Students</a></li>
            <li><a href="{{route('addSclStu')}}">Add School Students</a></li>
            <li><a href="{{route('addStdCos')}}">Add & Update Student Courses</a></li>
            <li><a href="{{route('billCourse')}}">Bill A Course</a></li>
            <li><a href="{{route('viewCourses')}}">View Course</a></li>
        </ul>
    </li>
    <li>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Inventories<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li class="hidden"><a href="#"></a></li>
            <li><a href="{{route('viewInventory')}}">View Inventory</a></li>
            <li><a href="{{route('updateInventory')}}">Update Inventory</a></li>
        </ul>
    </li>
    <li>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li class="hidden"><a href="#"></a></li>
            <li><a href="{{route('viewDailyReport')}}">Daily Report</a></li>
            <li><a href="{{route('viewDailyTraReport')}}">Daily Transaction Report</a></li>
            <li><a href="{{route('viewFeeHistory')}}">Fees History Report</a></li>
            <li><a href="{{route('printTermFee')}}">Print Term Fee</a></li>
            <li><a href="{{route('viewArrears')}}">Payment Arrears List</a></li>
            <li><a href="{{route('viewMonthlyRpt')}}">Monthly Report</a></li>
        </ul>
    </li>
    <li class="lvl">
        <a href="{{route('userRegister')}}">User Registration</a>
    </li>
</ul>