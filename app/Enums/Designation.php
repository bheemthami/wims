<?php

namespace App\Enums;

enum Designation: string
{

  // SMC Designations
  case CHAIRPERSON = 'chairperson';
  case MEMBER_SECRETARY = 'member-secretary';
  case MEMBER = 'member';
  case TEACHER_REPRESENTATIVE = 'teacher-representative';
  case LOCAL_GOVERNMENT_REPRESENTATIVE = 'local-government-representative';

    // Teacher Designations
  case PRINCIPAL = 'principal';
  case HEAD_TEACHER = 'head-teacher';
  case VICE_PRINCIPAL = 'vice-principal';
  case ASSISTANT_HEAD_TEACHER = 'assistant-head-teacher';
  case TEACHER = 'teacher';
  case ACCOUNTANT = 'accountant';
  case LIBRARIAN = 'librarian';
  case SCHOOL_NURSE = 'school-nurse';
  case SCHOOL_ASSISTANT = 'school-assistant';
  case SUPPORT_STAFF = 'support-staff';

  public function slug(): string
  {
    return $this->value;
  }

  public function title(): string
  {
    return match ($this) {
      self::CHAIRPERSON => 'Chairperson',
      self::MEMBER_SECRETARY => 'Member Secretary',
      self::MEMBER => 'Member',
      self::TEACHER_REPRESENTATIVE => 'Teacher Representative',
      self::LOCAL_GOVERNMENT_REPRESENTATIVE => 'Local Government Representative',
      self::PRINCIPAL => 'Principal',
      self::HEAD_TEACHER => 'Head Teacher',
      self::VICE_PRINCIPAL => 'Vice Principal',
      self::ASSISTANT_HEAD_TEACHER => 'Assistant Head Teacher',
      self::TEACHER => 'Teacher',
      self::ACCOUNTANT => 'Accountant',
      self::LIBRARIAN => 'Librarian',
      self::SCHOOL_NURSE => 'School Nurse',
      self::SCHOOL_ASSISTANT => 'School Assistant',
      self::SUPPORT_STAFF => 'Support Staff',
    };
  }
}
