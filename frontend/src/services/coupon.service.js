import { fetchWrapper } from "../helpers/fetch-wrapper";

const baseUrl = "http://localhost:8000/api/coupon";

export const couponService = {
  list,
  hide,
};

async function list() {
  const response = await fetchWrapper.get(`${baseUrl}/list`);
  const data = await response.json();

  if (!response.ok) {
    throw new Error(
      (data.message && data.message) || "Could not fetch coupons!"
    );
  }

  return data;
}

async function hide(id) {
  const response = await fetchWrapper.post(`${baseUrl}/hide`, { id });
  const data = await response.json();

  if (!response.ok) {
    throw new Error((data.message && data.message) || "Could not hide coupon!");
  }

  return data;
}
