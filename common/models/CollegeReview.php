<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "college_review".
 *
 * @property int $id
 * @property string $visitor_name
 * @property string $college_name
 * @property string $highest_education
 * @property string $year_completion
 * @property string $current_status
 * @property string $email_id
 * @property string $contact_number
 * @property string $sumerize_review
 * @property string $placement_percent
 * @property string $placement_salary_offer
 * @property string $placement_companies
 * @property string $placement_roles
 * @property string $placement_internship
 * @property string $infra_infrastructure
 * @property string $infra_falilities
 * @property string $hostel_boys
 * @property string $hostel_mesh
 * @property string $hostel_ac
 * @property string $hostel_other_facilities
 * @property string $hostel_bed_shared
 * @property string $hostel_girl_other_facilities
 * @property string $hostel_girl_mesh
 * @property string $hostel_girl_ac
 * @property string $hostel_girl_facilities
 * @property string $hostel_girl_bed_shared
 * @property string $facility_course
 * @property string $other_details_course_best
 * @property string $other_details_course_improve
 * @property string $other_details_course_extra
 * @property string $title_review
 * @property double $rate_value_money
 * @property double $rate_infra
 * @property double $rate_food_acc
 * @property double $rate_college_crowd
 * @property double $rate_campus_life
 * @property double $rate_faculty
 * @property double $rate_visiting_faculty_lectures
 * @property double $rate_admin_staff
 * @property double $rate_course_curriculum
 * @property double $rate_internship
 * @property double $rate_placement
 * @property int $admission_recommend
 * @property string $other_reviews
 * @property string $review_status
 * @property string $course
 * @property string $program
 * @property string $created_at
 * @property string $updated_at
 */
class CollegeReview extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'college_review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['visitor_name', 'college_name', 'highest_education', 'year_completion', 'current_status', 'email_id', 'contact_number'], 'required'],
            [['highest_education', 'year_completion', 'email_id', 'hostel_boys', 'hostel_mesh', 'hostel_ac', 'hostel_bed_shared', 'hostel_girl_other_facilities', 'hostel_girl_mesh', 'hostel_girl_ac', 'hostel_girl_bed_shared', 'review_status'], 'string'],
            [['contact_number', 'admission_recommend'], 'integer'],
            [['rate_value_money', 'rate_infra', 'rate_food_acc', 'rate_college_crowd', 'rate_campus_life', 'rate_faculty', 'rate_visiting_faculty_lectures', 'rate_admin_staff', 'rate_course_curriculum', 'rate_internship', 'rate_placement'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['visitor_name', 'sumerize_review', 'infra_falilities', 'hostel_other_facilities', 'hostel_girl_facilities', 'facility_course', 'other_details_course_best', 'other_details_course_improve', 'other_details_course_extra', 'title_review', 'other_reviews'], 'string', 'max' => 250],
            [['college_name', 'placement_companies', 'placement_roles', 'placement_internship', 'infra_infrastructure'], 'string', 'max' => 50],
            [['current_status', 'placement_salary_offer'], 'string', 'max' => 10],
            [['placement_percent'], 'string', 'max' => 5],
            [['course', 'program'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'visitor_name' => 'Visitor Name',
            'college_name' => 'University Name',
            'highest_education' => 'Highest Education',
            'year_completion' => 'Year Completion',
            'current_status' => 'Current Status',
            'email_id' => 'Email ID',
            'contact_number' => 'Contact Number',
            'sumerize_review' => 'Sumerize Review',
            'placement_percent' => 'Placement Percent',
            'placement_salary_offer' => 'Placement Salary Offer',
            'placement_companies' => 'Placement Companies',
            'placement_roles' => 'Placement Roles',
            'placement_internship' => 'Placement Internship',
            'infra_infrastructure' => 'Infra Infrastructure',
            'infra_falilities' => 'Infra Falilities',
            'hostel_boys' => 'Hostel Boys',
            'hostel_mesh' => 'Hostel Mesh',
            'hostel_ac' => 'Hostel Ac',
            'hostel_other_facilities' => 'Hostel Other Facilities',
            'hostel_bed_shared' => 'Hostel Bed Shared',
            'hostel_girl_other_facilities' => 'Hostel Girl Other Facilities',
            'hostel_girl_mesh' => 'Hostel Girl Mesh',
            'hostel_girl_ac' => 'Hostel Girl Ac',
            'hostel_girl_facilities' => 'Hostel Girl Facilities',
            'hostel_girl_bed_shared' => 'Hostel Girl Bed Shared',
            'facility_course' => 'Facility Course',
            'other_details_course_best' => 'Other Details Course Best',
            'other_details_course_improve' => 'Other Details Course Improve',
            'other_details_course_extra' => 'Other Details Course Extra',
            'title_review' => 'Title Review',
            'rate_value_money' => 'Rate Value Money',
            'rate_infra' => 'Rate Infra',
            'rate_food_acc' => 'Rate Food Acc',
            'rate_college_crowd' => 'Rate College Crowd',
            'rate_campus_life' => 'Rate Campus Life',
            'rate_faculty' => 'Rate Faculty',
            'rate_visiting_faculty_lectures' => 'Rate Visiting Faculty Lectures',
            'rate_admin_staff' => 'Rate Admin Staff',
            'rate_course_curriculum' => 'Rate Course Curriculum',
            'rate_internship' => 'Rate Internship',
            'rate_placement' => 'Rate Placement',
            'admission_recommend' => 'Admission Recommend',
            'other_reviews' => 'Other Reviews',
            'review_status' => 'Review Status',
            'course' => 'Course',
            'program' => 'Program',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
