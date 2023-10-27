import type IAddress from '@/interfaces/IAddress';
import type ICreditCard from '@/interfaces/ICreditCard';
import type IEmployment from '@/interfaces/IEmployment';
import type ISubscription from '@/interfaces/ISubscription';

export default interface IUser {
  id: number;
  uid: string;
  password: string;
  first_name: string;
  last_name: string;
  username: string;
  email: string;
  avatar: string;
  gender: string;
  phone_number: string;
  social_insurance_number: string;
  date_of_birth: Date;
  employment: IEmployment;
  address: IAddress;
  credit_card: ICreditCard;
  subscription: ISubscription;
}
