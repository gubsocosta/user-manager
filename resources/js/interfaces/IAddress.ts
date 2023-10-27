import ICoordinates from '@/interfaces/ICoordinates';

export default interface IAddress {
  city: string;
  street_name: string;
  street_address: string;
  zip_code: string;
  state: string;
  country: string;
  coordinates: ICoordinates;
}
